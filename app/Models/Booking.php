<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

protected $fillable = [
    'user_id',
    'tour_id',
    'destination_id',
    'flight_id',
    'travel_date',
    'people_count',
    'status',
];

public function destination()
{
    return $this->belongsTo(Destination::class);
}

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}