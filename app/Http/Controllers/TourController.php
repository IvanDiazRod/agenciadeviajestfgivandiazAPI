<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    // Obtener todos los tours
public function index(Request $request)
{
    // Empezamos una consulta
    $query = Tour::query();

    // Si viene un destino en la URL (?destination=...)
    if ($request->has('destination') && $request->destination != '') {
        $query->where('location', 'like', '%' . $request->destination . '%');
    }

    // Si viene una duración (?duration=...)
    if ($request->has('duration') && $request->duration != '') {
        // Ejemplo: Si duration es "10", buscamos tours de 10 días o menos
        $query->where('duration_days', '<=', $request->duration);
    }

    return response()->json($query->get(), 200);
}
public function show($id)
{
    // Buscamos el tour por su ID
    $tour = Tour::find($id);

    // Si no existe, mandamos un error 404 claro
    if (!$tour) {
        return response()->json(['message' => 'Tour no encontrado'], 404);
    }

    // Si existe, lo devolvemos con un 200 OK
    return response()->json($tour, 200);
}
}