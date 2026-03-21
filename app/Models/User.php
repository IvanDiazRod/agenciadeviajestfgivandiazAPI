<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // <--- NO OLVIDES ESTO PARA LOS TOKENS

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     * He incluido todos los campos de tu formulario de React.
     */
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
    // Si hay una foto en la DB, crea la URL pública. Si no, usa un avatar por defecto.
    return $this->profile_photo_path 
        ? asset('storage/' . $this->profile_photo_path) 
        : "https://ui-avatars.com/api/?name=" . urlencode($this->firstname);
}

    /**
     * Los atributos que deben estar ocultos en las respuestas JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casteo de atributos.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'dateofbirth' => 'date', // Opcional: para tratarlo como objeto Carbon
        ];
    }
}