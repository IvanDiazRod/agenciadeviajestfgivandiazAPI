<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // ESTA ES LA PARTE QUE SOLUCIONA EL ERROR:
// Añade destination a los campos permitidos
protected $fillable = [
    'user_id',
    'tour_id',
    'destination_id',
    'flight_id', // <--- AÑADE ESTO
    'travel_date',
    'people_count',
    'status',
];

// Define la relación
public function destination()
{
    return $this->belongsTo(Destination::class);
}

    // Relación con el Tour (para poder mostrar el nombre del viaje en el perfil)
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}