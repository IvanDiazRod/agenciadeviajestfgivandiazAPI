<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'firstname',
        'surname',
        'secondsurname',
        'email',
        'dateofbirth',
        'gender',
        'password',
        'profile_photo_path',
    ];

    protected $appends = ['profile_photo_url'];

    public function getProfilePhotoUrlAttribute()
{
    return $this->profile_photo_path 
        ? asset('storage/' . $this->profile_photo_path) 
        : "https://ui-avatars.com/api/?name=" . urlencode($this->firstname);
}

public function flights() {
    return $this->hasMany(Flight::class);
}

public function bookings() {
    return $this->hasMany(Booking::class);
}
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'dateofbirth' => 'date',
        ];
    }
}