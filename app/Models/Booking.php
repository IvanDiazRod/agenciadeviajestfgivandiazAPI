<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // ESTA ES LA PARTE QUE SOLUCIONA EL ERROR:
    protected $fillable = [
        'user_id',      // Este es el que faltaba y causaba el Error 500
        'tour_id', 
        'travel_date', 
        'people_count', 
        'status'
    ];

    // Relación con el Tour (para poder mostrar el nombre del viaje en el perfil)
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}