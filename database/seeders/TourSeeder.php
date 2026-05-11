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
        Schema::disableForeignKeyConstraints();
        Tour::truncate();
        Schema::enableForeignKeyConstraints();

        $tours = [
            [
                'title' => 'Ha Giang Loop',
                'description' => 'An important motorbike tour.',
                'price' => 1100.00,
                'duration_days' => 7,
                'location' => 'Hanoi',
                'image_url' => '/img/tours/hagiangloop/HaGiangLoop1.jpg'
            ],
            [
                'title' => 'Familia Sagrada Tour',
                'description' => 'The Familia Sagrada Tour is the best spanish tour, and so cheap.',
                'price' => 480.00,
                'duration_days' => 4,
                'location' => 'Madrid',
                'image_url' => '/img/tours/sagradafamilia/SagradaFamilia1.jpg'
            ],
            [
                'title' => 'Eiffel Tower Tour',
                'description' => 'The most beautiful tower in Paris deserves an important and well organized tour.',
                'price' => 730.00,
                'duration_days' => 1,
                'location' => 'Paris',
                'image_url' => '/img/tours/eiffeltower/EiffelTower1.jpg'
            ],
        ];

        foreach ($tours as $tourData) {
            Tour::create($tourData);
        }
    }
}