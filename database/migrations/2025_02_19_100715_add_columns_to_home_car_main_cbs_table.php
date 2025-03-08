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
        Schema::table('home_car_main_cbs', function (Blueprint $table) {
            $table->integer('net_amount_debit')->default(0);
            $table->integer('net_amount_credit')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_car_main_cbs', function (Blueprint $table) {
            //
        });
    }
};
