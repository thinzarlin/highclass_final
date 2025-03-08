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
        Schema::create('home_car_mains', function (Blueprint $table) {
            $table->id();
            $table->integer('ref_no')->unique();
            $table->date('out_date');
            $table->date('in_date');
            $table->foreignId('tour_id')->constrained('tours')->restrictOnDelete();
            $table->foreignId('car_id')->constrained('cars')->restrictOnDelete();
            $table->foreignId('daily_car_list_id')->constrained('daily_car_lists')->restrictOnDelete();

            $table->json('tickets');
            $table->integer('total_people')->default(0);
            $table->integer('total_ticket')->default(0);
            $table->integer('insurance')->default(0);
            $table->integer('ticket_income')->default(0);

            $table->integer('total_cargo')->default(0);
            $table->integer('cash_cargo')->default(0);
            $table->integer('credit_cargo')->default(0);
            $table->integer('cargo_bd')->default(0);
            $table->integer('lu_par_cargo')->default(0);
            $table->json('out_cargos');
            $table->integer('cargo_income')->default(0);

            $table->integer('grand_total')->default(0);

            $table->integer('gate_percent')->default(0);
            $table->integer('gate_commission')->default(0);

            $table->integer('water_small_qty')->default(0);
            $table->integer('water_small_amt')->default(0);
            $table->integer('water_large_qty')->default(0);
            $table->integer('water_large_amt')->default(0);
            $table->integer('drink_qty')->default(0);
            $table->integer('drink_amt')->default(0);
            $table->integer('snack_qty')->default(0);
            $table->integer('snack_amt')->default(0);
            $table->integer('snack_special_qty')->default(0);
            $table->integer('snack_special_amt')->default(0);
            $table->integer('towel_qty')->default(0);
            $table->integer('towel_amt')->default(0);
            $table->integer('plastic_bag_qty')->default(0);
            $table->integer('plastic_bag_amt')->default(0);
            $table->integer('candy_qty')->default(0);
            $table->integer('candy_amt')->default(0);
            $table->integer('guest_reg')->default(0);
            $table->integer('medicine')->default(0);
            $table->integer('coffee')->default(0);
            $table->integer('ticket_disc')->default(0);
            $table->integer('total_expense')->default(0);

            $table->integer('pot_sat')->default(0);
            $table->integer('la_tha')->default(0);
            $table->integer('copy')->default(0);
            $table->integer('total_rta')->default(0);

            $table->integer('ygn_lan_tg_ticket')->default(0);
            $table->integer('lan_tg_ticket')->default(0);
            $table->integer('gate_out')->default(0);
            $table->integer('ferry')->default(0);
            $table->integer('ask_khauk_to')->default(0);
            $table->integer('deli')->default(0);
            $table->integer('khauk_to')->default(0);
            $table->integer('other_expense')->default(0);
            $table->integer('site_shin')->default(0);

            $table->integer('total')->default(0);
            
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
        Schema::dropIfExists('home_car_mains');
    }
};
