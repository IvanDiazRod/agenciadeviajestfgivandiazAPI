<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 1. IMPORTACIONES (Asegúrate de que no falte ninguna)
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FlightBookingController;

/*
|--------------------------------------------------------------------------
| Public Routes (Rutas Públicas)
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/tours', [TourController::class, 'index']);
Route::get('/tours/{id}', [TourController::class, 'show']);

Route::get('/destinations', [DestinationController::class, 'index']);
Route::get('/destinations/{slug}', [DestinationController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Protected Routes (Rutas Protegidas con Sanctum)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    
    // Reservas
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);
    Route::post('/bookings', [BookingController::class, 'store']);

    // Vuelos
    Route::get('/my-flights', [FlightController::class, 'myFlights']);

    // Perfil
    Route::post('/user/photo', [AuthController::class, 'updateProfilePhoto']);
    Route::post('/logout', [AuthController::class, 'logout']); // Recomendado añadirlo

        // Rutas antiguas de Tours
    
    // Rutas nuevas de Vuelos
    Route::post('/flight-bookings', [FlightBookingController::class, 'store']);

});