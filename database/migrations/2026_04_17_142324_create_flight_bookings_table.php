<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::create('flight_bookings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('destination_id')->constrained(); // A dónde vuelan
    $table->string('airline_name')->nullable();
    $table->string('seat_number')->nullable();
    $table->dateTime('departure_date');
    $table->decimal('price', 8, 2);
    $table->string('status')->default('confirmed');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_bookings');
    }
};
