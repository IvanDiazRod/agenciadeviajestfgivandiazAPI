<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination_id',
        'airline_name',
        'seat_number',
        'departure_date',
        'price',
        'status'
    ];

    // Relación con el destino para saber a dónde vuelan
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}