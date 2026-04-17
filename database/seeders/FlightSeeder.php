<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;
use App\Models\User;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        // Buscamos al primer usuario para asignarle los vuelos
        $user = User::first();

        if ($user) {
            Flight::create([
                'user_id'        => $user->id,
                'origin'         => 'Madrid (MAD)',
                'destination'    => 'Tokyo (NRT)',
                'airline_name'   => 'Iberia',
                'departure_date' => '2026-10-15 10:30:00',
                'seat_number'    => '14A',
                'price'          => 850.00,
                'status'         => 'confirmed'
            ]);

            Flight::create([
                'user_id'        => $user->id,
                'origin'         => 'Barcelona (BCN)',
                'destination'    => 'New York (JFK)',
                'airline_name'   => 'American Airlines',
                'departure_date' => '2026-12-05 18:45:00',
                'seat_number'    => '22C',
                'price'          => 620.50,
                'status'         => 'pending'
            ]);
        }
    }
}