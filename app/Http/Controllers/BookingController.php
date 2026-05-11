<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'nullable|exists:tours,id',
            'destination_id' => 'nullable|exists:destinations,id',
            'flight_id' => 'nullable',
            'travel_date' => 'required|date',
            'people_count' => 'required|integer|min:1',
        ]);

        try {
            $data = [
                'user_id' => auth()->id(),
                'travel_date' => $request->travel_date,
                'people_count' => $request->people_count,
                'status' => 'confirmed',
            ];

            if ($request->has('tour_id')) $data['tour_id'] = $request->tour_id;
            if ($request->has('destination_id')) $data['destination_id'] = $request->destination_id;
            if ($request->has('flight_id')) $data['flight_id'] = $request->flight_id;

            $booking = Booking::create($data);

            return response()->json([
                'message' => '¡Reserva realizada con éxito!',
                'booking' => $booking
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function myBookings()
    {
        try {
            $userId = auth()->id();

            if (!$userId) {
                return response()->json(['message' => 'Usuario no identificado'], 401);
            }

            $bookings = Booking::where('user_id', $userId)
                ->where(function($query) {
                    $query->whereNotNull('tour_id')
                          ->orWhereNotNull('destination_id');
                })
                ->whereNull('flight_id')
                ->with(['tour', 'destination'])
                ->orderBy('travel_date', 'desc')
                ->get();

            return response()->json($bookings, 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener tours',
                'error' => $e->getMessage()
            ], 500);
        }
        \Log::info('Registros de tours:', $bookings->toArray());
    }

    public function myFlights()
    {
        try {
            $userId = auth()->id();

            if (!$userId) {
                return response()->json(['message' => 'Usuario no identificado'], 401);
            }

            $flights = Booking::where('user_id', $userId)
                ->whereNotNull('flight_id')
                ->orderBy('travel_date', 'desc')
                ->get();

            return response()->json($flights, 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener vuelos',
                'error' => $e->getMessage()
            ], 500);
        }
        \Log::info('Registros de vuelos:', $flights->toArray());
    }
    public function destroy($id)
{
    $user = auth()->user();

    $booking = $user->bookings()->find($id);

    if (!$booking) {
        return response()->json(['message' => 'Reserva no encontrada o no autorizada'], 404);
    }

    $booking->delete();

    return response()->json(['message' => 'Reserva cancelada correctamente'], 200);
}
}