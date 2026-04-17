<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlightController extends Controller
{
    public function myFlights()
    {
        // Obtenemos los vuelos del usuario autenticado a través de la relación
        $flights = Auth::user()->flights; 
        return response()->json($flights);
    }
}