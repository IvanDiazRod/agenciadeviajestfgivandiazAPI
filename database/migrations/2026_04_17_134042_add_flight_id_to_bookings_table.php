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
        // Añadimos la columna flight_id como nullable (importante para que los Tours no fallen)
        $table->unsignedBigInteger('flight_id')->nullable()->after('destination_id');
    });
}

public function down()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropColumn('flight_id');
    });
}
};
