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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_no');
            $table->string('owner')->nullable();
            $table->foreignId('driver_1_id')->nullable()->constrained('car_staff')->nullOnDelete();
            $table->foreignId('driver_2_id')->nullable()->constrained('car_staff')->nullOnDelete();
            $table->foreignId('spare_id')->nullable()->constrained('car_staff')->nullOnDelete();
            $table->foreignId('crew_id')->nullable()->constrained('car_staff')->nullOnDelete();
            $table->string('type')->nullable();
            $table->string('type_detail')->nullable();
            $table->integer('people')->nullable();
            $table->boolean('current')->default(true);
            $table->boolean('home_car')->default(true);
            $table->boolean('sold')->default(false);
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('cars');
    }
};
