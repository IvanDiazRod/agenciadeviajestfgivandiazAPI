<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Crear una nueva reserva (Tour o Vuelo)
     */
    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'nullable|exists:tours,id',
            'destination_id' => 'nullable|exists:destinations,id',
            'flight_id' => 'nullable', // Asegúrate de tener esta columna en tu DB
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

            // Asignamos el ID correspondiente según lo que venga en la petición
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

    /**
     * Obtiene SOLO los TOURS (Excluye vuelos)
     */
    public function myBookings()
    {
        try {
            $userId = auth()->id();

            if (!$userId) {
                return response()->json(['message' => 'Usuario no identificado'], 401);
            }

            // Filtramos: Que tenga Tour o Destino, pero que el campo de vuelo esté vacío
            $bookings = Booking::where('user_id', $userId)
                ->where(function($query) {
                    $query->whereNotNull('tour_id')
                          ->orWhereNotNull('destination_id');
                })
                ->whereNull('flight_id') // <--- Esto evita que los vuelos salgan aquí
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

    /**
     * Obtiene SOLO los VUELOS (Excluye tours)
     */
    public function myFlights()
    {
        try {
            $userId = auth()->id();

            if (!$userId) {
                return response()->json(['message' => 'Usuario no identificado'], 401);
            }

            // Filtramos: Solo registros donde flight_id tenga valor
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
    // Obtenemos al usuario autenticado por el Token
    $user = auth()->user();

    // Buscamos la reserva DENTRO de las reservas de ese usuario
    $booking = $user->bookings()->find($id);

    if (!$booking) {
        return response()->json(['message' => 'Reserva no encontrada o no autorizada'], 404);
    }

    $booking->delete();

    return response()->json(['message' => 'Reserva cancelada correctamente'], 200);
}
}