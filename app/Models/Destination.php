<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model

{

protected $casts = [
    'images' => 'array',
];

    public function up()
    
{
    Schema::create('destinations', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->string('country');
        $table->string('src'); // Imagen principal
        $table->json('images')->nullable(); // Guardamos el array como JSON
        $table->text('description');
        $table->decimal('price', 10, 2);
        $table->timestamps();
    });
}

}
