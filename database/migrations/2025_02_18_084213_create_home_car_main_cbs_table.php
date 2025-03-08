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
        Schema::create('home_car_main_cbs', function (Blueprint $table) {
            $table->id();
            $table->integer('ref_no')->unique();
            $table->foreignId('main_id')->constrained('home_car_mains')->restrictOnDelete();
            $table->integer('total_income')->default(0);
            $table->integer('total_expense')->default(0);
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
        Schema::dropIfExists('home_car_main_cbs');
    }
};
