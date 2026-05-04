<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
{
    $destinations = [
        [
            'name' => 'Paris', 'slug' => 'paris', 'country' => 'France',
            'src' => '/img/cities/paris/France.avif', 'description' => 'The city of lights...',
            'price' => 1200, 'images' => ["/img/cities/paris/France.avif", "img/paris2.jpg"] // <--- Sin json_encode()
        ],
        // ... repite para Kyoto, Santorini, etc.
    ];

    foreach ($destinations as $dest) {
        \App\Models\Destination::create($dest);
    }
}
}
