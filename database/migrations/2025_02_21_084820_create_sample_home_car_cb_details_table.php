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
        Schema::create('sample_home_car_cb_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cb_id')->constrained('home_car_main_cbs')->cascadeOnDelete();
            $table->integer('line_no');
            $table->foreignId('coa_id')->constrained('coas')->restrictOnDelete();
            $table->text('remark')->nullable();
            $table->integer('debit')->default(0);
            $table->integer('credit')->default(0);
            $table->integer('credit_cargo')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_home_car_cb_details');
    }
};
