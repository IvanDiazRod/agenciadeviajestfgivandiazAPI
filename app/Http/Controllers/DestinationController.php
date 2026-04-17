<?php

namespace App\Http\Controllers;

class DestinationController extends Controller
{
    public function index() {
    return response()->json(\App\Models\Destination::all());
}
public function show($slug)
{
    // Asegúrate de que aquí diga Destination y no Tour
    $destination = \App\Models\Destination::where('slug', $slug)->firstOrFail();
    return response()->json($destination);
}
}