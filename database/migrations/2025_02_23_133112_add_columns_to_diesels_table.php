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
        Schema::table('diesels', function (Blueprint $table) {
            $table->foreignId('tour_id')->constrained('tours')->restrictOnDelete();
            $table->foreignId('car_id')->constrained('cars')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diesels', function (Blueprint $table) {
            //
        });
    }
};
