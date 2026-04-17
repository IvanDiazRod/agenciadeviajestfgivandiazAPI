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
    Schema::table('bookings', function (Blueprint $table) {
        // 1. Añadimos destination_id después de tour_id por orden visual
        $table->foreignId('destination_id')
              ->nullable()
              ->after('tour_id')
              ->constrained()
              ->onDelete('cascade');

        // 2. Hacer tour_id nullable
        // NOTA: Si esto te da error, puede que necesites instalar: 
        // composer require doctrine/dbal
        $table->foreignId('tour_id')->nullable()->change();
    });
}

public function down(): void
{
    Schema::table('bookings', function (Blueprint $table) {
        // 1. Eliminamos la clave foránea y la columna
        $table->dropForeign(['destination_id']);
        $table->dropColumn('destination_id');

        // 2. (Opcional) Revertir tour_id a NO nullable si antes lo era
        $table->foreignId('tour_id')->nullable(false)->change();
    });
}
};
