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
        Schema::create('daily_car_lists', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no')->unique();
            $table->date('date');
            $table->integer('sr_no');
            $table->foreignId('tour_id')->constrained('tours')->restrictOnDelete();
            $table->foreignId('car_id')->constrained('cars')->restrictOnDelete();
            $table->foreignId('driver_1_id')->nullable()->constrained('car_staff')->nullOnDelete();
            $table->foreignId('driver_2_id')->nullable()->constrained('car_staff')->nullOnDelete();
            $table->foreignId('spare_id')->nullable()->constrained('car_staff')->nullOnDelete();
            $table->foreignId('crew_id')->nullable()->constrained('car_staff')->nullOnDelete();
            $table->foreignId('created_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_car_lists');
    }
};
