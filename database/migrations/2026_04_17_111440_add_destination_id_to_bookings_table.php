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
        $table->foreignId('destination_id')
              ->nullable()
              ->after('tour_id')
              ->constrained()
              ->onDelete('cascade');
        $table->foreignId('tour_id')->nullable()->change();
    });
}

public function down(): void
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropForeign(['destination_id']);
        $table->dropColumn('destination_id');

        $table->foreignId('tour_id')->nullable(false)->change();
    });
}
};
