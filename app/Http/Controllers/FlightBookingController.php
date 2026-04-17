<?php

namespace App\Http\Controllers;

use App\Models\FlightBooking;
use Illuminate\Http\Request;

class FlightBookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'departure_date' => 'required|date',
            'price' => 'required|numeric',
        ]);

        $flight = FlightBooking::create([
            'user_id' => auth()->id(),
            'destination_id' => $request->destination_id,
            'departure_date' => $request->departure_date,
            'price' => $request->price,
            'airline_name' => 'SkyTravel Airlines', // Dato de prueba
            'seat_number' => '12B', // Dato de prueba
            'status' => 'confirmed'
        ]);

        return response()->json(['message' => '¡Vuelo reservado!', 'flight' => $flight], 201);
    }

    public function myFlights()
    {
        return response()->json(
            FlightBooking::where('user_id', auth()->id())
                ->with('destination')
                ->orderBy('departure_date', 'asc')
                ->get()
        );
    }
}