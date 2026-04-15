<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'travel_date' => 'required|date|after:today',
            'people_count' => 'required|integer|min:1',
        ]);

        // 1. Usamos Auth::id() que detectará el ID del token enviado
        $booking = Booking::create([
            'user_id' => Auth::id(), 
            'tour_id' => $validated['tour_id'],
            'travel_date' => $validated['travel_date'],
            'people_count' => $validated['people_count'],
            'status' => 'confirmed',
        ]);

        return response()->json([
            'message' => 'Booking successful!',
            'booking' => $booking->load('tour')
        ], 201);
    }

    // 2. IMPORTANTE: Recibe el objeto $request para identificar al usuario
    public function myBookings(Request $request)
    {
        // 3. Obtenemos el usuario autenticado a través del token
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }

        // 4. Filtramos dinámicamente por el ID del usuario actual
        $bookings = Booking::with('tour')
            ->where('user_id', $user->id)
            ->get();

        return response()->json($bookings);
    }
}