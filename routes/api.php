<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FlightBookingController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/tours', [TourController::class, 'index']);
Route::get('/tours/{id}', [TourController::class, 'show']);

Route::get('/destinations', [DestinationController::class, 'index']);
Route::get('/destinations/{slug}', [DestinationController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);
    Route::post('/bookings', [BookingController::class, 'store']);

    Route::get('/my-flights', [FlightController::class, 'myFlights']);

    Route::post('/user/photo', [AuthController::class, 'updateProfilePhoto']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/my-flights', [FlightBookingController::class, 'myFlights']);
    Route::post('/flight-bookings', [FlightBookingController::class, 'store']);

    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);

});