<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
public function run(): void
{
    // Comenta esto porque usa 'name' (que no existe en tu tabla)
    
    /*User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);*/
    

    // Llama a tu seeder de Tours que es el que nos interesa ahora
}
}
