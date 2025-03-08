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
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->integer('ref_no')->unique();
            $table->date('date');
            $table->foreignId('tour_id')->constrained('tours')->restrictOnDelete();
            $table->foreignId('car_id')->constrained('cars')->restrictOnDelete();
            $table->string('cargo_no');
            $table->foreignId('from_city_id')->constrained('cities')->restrictOnDelete();
            $table->foreignId('from_gate_id')->nullable()->constrained('gates')->restrictOnDelete();
            $table->string('from_gate_note')->nullable();
            $table->foreignId('to_city_id')->constrained('cities')->restrictOnDelete();
            $table->foreignId('to_gate_id')->nullable()->constrained('gates')->restrictOnDelete();
            $table->string('to_gate_note')->nullable();
            $table->string('sender_name');
            $table->string('sender_phone')->nullable();
            $table->string('receiver_name');
            $table->string('receiver_phone')->nullable();

            $table->string('item_name');
            $table->integer('qty');
            $table->integer('cargo_amt')->default(0);
            // $table->integer('commission')->default(0);
            $table->integer('khauk_to')->default(0);   
            $table->integer('deli')->default(0);
            // $table->integer('paid_amt')->default(0);
            // $table->integer('balance')->default(0);
            $table->integer('site_shin')->default(0);
            $table->integer('site_shin_prev_car')->default(0);

            // $table->integer('cash_cargo_amt')->default(0);
            // $table->integer('credit_cargo_amt')->default(0);
            // $table->integer('cash_khauk_to')->default(0);
            // $table->integer('credit_khauk_to')->default(0);
            // $table->integer('cash_deli')->default(0);
            // $table->integer('credit_deli')->default(0);
            $table->integer('bawdar_fee')->default(0);
            $table->integer('total')->default(0);

            $table->string('remark')->nullable();
            // $table->foreignId('current_city_id')->nullable()->constrained('cities')->nullOnDelete();
            // $table->foreignId('current_gate_id')->nullable()->constrained('gates')->nullOnDelete();
            // $table->string('current_gate_note')->nullable();
            // $table->string('current_state')->nullable();
            // $table->string('status')->nullable();

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
        Schema::dropIfExists('cargos');
    }
};
