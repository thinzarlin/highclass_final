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
        Schema::create('owner_main_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->unique()->constrained('tours')->restrictOnDelete();
            $table->integer('water_small')->default(0);
            $table->integer('water_large')->default(0);
            $table->integer('drink')->default(0);
            $table->integer('snack_special')->default(0);
            $table->integer('snack')->default(0);
            $table->integer('towel')->default(0);
            $table->integer('plastic_bag')->default(0);
            $table->integer('candy')->default(0);
            $table->integer('guest_reg')->default(0);
            $table->integer('medicine')->default(0);
            $table->integer('pot_sat')->default(0);
            $table->integer('la_tha')->default(0);
            $table->integer('ask')->default(0);
            $table->integer('gate_out')->default(0);
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
        Schema::dropIfExists('owner_main_settings');
    }
};
