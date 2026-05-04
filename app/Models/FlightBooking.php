<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{

protected $fillable = [
    'user_id', 
    'destination_id', 
    'departure_date', 
    'price', 
    'status', 
    'airline_name', 
    'seat_number'
];

    public function destination() {
        return $this->belongsTo(Destination::class);
    }
}