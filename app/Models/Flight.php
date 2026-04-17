<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = ['user_id', 'origin', 'destination', 'airline_name', 'departure_date', 'seat_number', 'price', 'status'];

    public function user() {
    
    return $this->belongsTo(User::class);
}
}
