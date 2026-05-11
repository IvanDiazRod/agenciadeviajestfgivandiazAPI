<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlightBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'destination_id', 
        'departure_date', 
        'return_date',
        'price', 
        'status', 
        'airline_name', 
        'seat_number',
        'type',
        'people_count'
    ];

    protected $casts = [
        'departure_date' => 'datetime',
        'return_date'    => 'datetime',
    ];

    public function destination() 
    {
        return $this->belongsTo(Destination::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}