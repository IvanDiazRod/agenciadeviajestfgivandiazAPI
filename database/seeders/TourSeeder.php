<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;
use Illuminate\Support\Facades\Schema;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Limpiamos la tabla ignorando restricciones de llave foránea temporalmente
        Schema::disableForeignKeyConstraints();
        Tour::truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Definimos nuestra lista de tours
        $tours = [
            [
                'title' => 'Safari en Tanzania',
                'description' => 'Observa los "Cinco Grandes" en el Serengueti con guías expertos.',
                'price' => 3200.00,
                'duration_days' => 7,
                'location' => 'Tanzania',
                'image_url' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801'
            ],
            [
                'title' => 'Luces del Norte en Noruega',
                'description' => 'Caza auroras boreales en los fiordos noruegos bajo el cielo ártico.',
                'price' => 2100.00,
                'duration_days' => 5,
                'location' => 'Noruega',
                'image_url' => 'https://images.unsplash.com/photo-1531366930477-4f1f11f6c04f'
            ],
            [
                'title' => 'Ruta del Tequila en México',
                'description' => 'Cultura, mariachis y los mejores campos de agave en Jalisco.',
                'price' => 1200.00,
                'duration_days' => 6,
                'location' => 'México',
                'image_url' => 'https://images.unsplash.com/photo-1518105779142-d975f22f1b0a'
            ],
            [
                'title' => 'Explora Japón Antiguo',
                'description' => 'Templos en Kyoto y luces de neón en Tokyo.',
                'price' => 2500.00,
                'duration_days' => 10,
                'location' => 'Japón',
                'image_url' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e'
            ]
        ];

        // 3. Los insertamos en la base de datos
        foreach ($tours as $tourData) {
            Tour::create($tourData);
        }
    }
}