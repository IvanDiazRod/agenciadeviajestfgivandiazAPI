<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'price', 
        'duration_days', 
        'location', 
        'image_url'
    ];

    // Relación: Un tour puede tener muchas reservas
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}