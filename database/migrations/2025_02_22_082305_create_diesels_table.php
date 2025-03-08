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
        Schema::create('diesels', function (Blueprint $table) {
            $table->id();
            $table->integer('ref_no')->unique();
            $table->date('out_date');
            $table->date('in_date');
            $table->date('purchase_date');
            $table->foreignId('daily_car_list_id')->nullable()->constrained('daily_car_lists')->nullOnDelete();
            $table->enum('route_type', ['in', 'out'])->default('out');
            $table->foreignId('shop_id')->constrained('diesel_shops')->restrictOnDelete();
            $table->foreignId('stock_id')->constrained('stocks')->restrictOnDelete();
            $table->float('liter')->default(0);
            $table->float('gallon')->default(0);
            $table->float('price')->default(0);
            $table->float('discount')->default(0);
            $table->float('amount')->default(0);
            $table->enum('payment_type', ['cash', 'credit'])->default('credit');
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
        Schema::dropIfExists('diesels');
    }
};
