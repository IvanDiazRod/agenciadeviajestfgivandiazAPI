<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{

    public function run() {
    
    $destinations = [
        [
            'name' => 'Paris', 'slug' => 'paris', 'country' => 'France',
            'src' => '/img/cities/paris/Paris1.jpg', 'description' => 'The city of lights',
            'price' => 1200, 'images' => ["/img/cities/paris/Paris2.jpg", "/img/cities/paris/Paris3.jpg", "/img/cities/paris/Paris4.jpg"]
        ],
        [
            'name' => 'Tokyo', 'slug' => 'tokyo', 'country' => 'Japan',
            'src' => '/img/cities/tokyo/Tokyo1.jpg', 'description' => 'A neon-lit metropolis where ancient traditions meet futuristic technology.',
            'price' => 2100, 'images' => ["/img/cities/tokyo/Tokyo2.jpg", "/img/cities/tokyo/Tokyo3.jpg", "/img/cities/tokyo/Tokyo4.jpg"]
        ],
        [
            'name' => 'Rome', 'slug' => 'rome', 'country' => 'Italy',
            'src' => '/img/cities/rome/Rome1.jpg', 'description' => 'The Eternal City, home to the Colosseum, grand ruins, and world-class pasta.',
            'price' => 1100, 'images' => ["/img/cities/rome/Rome2.jpg", "/img/cities/rome/Rome3.jpg", "/img/cities/rome/Rome4.jpg"]
        ],
        [
            'name' => 'New York', 'slug' => 'new-york', 'country' => 'USA',
            'src' => '/img/cities/newyork/NewYork1.jpg', 'description' => 'The Big Apple, famous for its skyline, Broadway shows, and Central Park.',
            'price' => 2500, 'images' => ["/img/cities/newyork/NewYork2.jpg", "/img/cities/newyork/NewYork3.jpg", "/img/cities/newyork/NewYork4.jpg"]
        ],
        [
            'name' => 'Cairo', 'slug' => 'cairo', 'country' => 'Egypt',
            'src' => '/img/cities/cairo/Cairo1.jpg', 'description' => 'Explore the majestic Pyramids of Giza and the historic treasures of the Nile.',
            'price' => 950, 'images' => ["/img/cities/cairo/Cairo2.jpg", "/img/cities/cairo/Cairo3.jpg", "/img/cities/cairo/Cairo4.jpg"]
        ],
        [
            'name' => 'Bali', 'slug' => 'bali', 'country' => 'Indonesia',
            'src' => '/img/cities/bali/Bali1.jpg', 'description' => 'A tropical paradise known for its volcanic mountains, iconic rice paddies, and coral reefs.',
            'price' => 1400, 'images' => ["/img/cities/bali/Bali2.jpg", "/img/cities/bali/Bali3.jpg", "/img/cities/bali/Bali4.jpg"]
        ],
        [
            'name' => 'London', 'slug' => 'london', 'country' => 'England',
            'src' => '/img/cities/london/London1.jpg', 'description' => 'The biggest city in England, London is full of interesting places to visit.',
            'price' => 3000, 'images' => ["/img/cities/london/London2.jpg", "/img/cities/london/London3.jpg", "/img/cities/london/London4.jpg"]
        ],
        [
            'name' => 'Hanoi', 'slug' => 'hanoi', 'country' => 'Vietnam',
            'src' => '/img/cities/hanoi/Hanoi1.jpg', 'description' => 'Be careful with the incredible quantity of motorbikes',
            'price' => 1100, 'images' => ["/img/cities/hanoi/Hanoi2.jpg", "/img/cities/hanoi/Hanoi3.jpg", "/img/cities/hanoi/Hanoi4.jpg"]
        ],
        [
            'name' => 'Guadalajara', 'slug' => 'guadalajara-jalisco', 'country' => 'Mexico',
            'src' => '/img/cities/guadalajara_jalisco/Guadalajara1.jpg', 'description' => 'A city where brave people live',
            'price' => 1300, 'images' => ["/img/cities/guadalajara_jalisco/Guadalajara2.jpg", "/img/cities/guadalajara_jalisco/Guadalajara3.jpg", "/img/cities/guadalajara_jalisco/Guadalajara4.jpg"]
        ],
        
    ];

    foreach ($destinations as $dest) {
            \App\Models\Destination::create($dest);
        }
    }
}