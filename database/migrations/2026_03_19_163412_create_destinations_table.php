<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('destinations', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique(); // <--- Faltaba esta
        $table->string('country');
        $table->string('src'); // <--- En tu tabla actual se llama image_url, cámbialo a src
        $table->text('description')->nullable();
        $table->decimal('price', 10, 2)->default(0); // <--- Faltaba esta
        $table->json('images')->nullable(); // <--- Faltaba esta para la galería
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
