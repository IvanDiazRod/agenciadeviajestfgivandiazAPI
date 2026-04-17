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
    Schema::create('flights', function (Blueprint $table) {
        $table->id();
        // Relacionamos el vuelo con un usuario
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        $table->string('origin');
        $table->string('destination');
        $table->string('airline_name');
        $table->dateTime('departure_date');
        $table->string('seat_number')->nullable();
        $table->decimal('price', 10, 2);
        $table->string('status')->default('confirmed'); // Por defecto confirmado
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
