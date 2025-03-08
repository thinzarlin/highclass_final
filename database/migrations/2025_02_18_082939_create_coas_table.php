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
        Schema::create('coas', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->string('name');
            $table->string('line_no');
            $table->integer('level')->default(1);
            $table->boolean('current')->default(true);

            $table->foreignId('sub_heading_id')->constrained('coa_sub_headings')->restrictOnDelete();
            $table->foreignId('account_type_id')->constrained('coa_account_types')->restrictOnDelete();
            $table->string('cash_flow_heading')->nullable();
            $table->foreignId('car_pl_heading_id')->nullable()->constrained('coa_car_pl_headings')->nullOnDelete();

            $table->nestedSet();
            
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
        Schema::dropIfExists('coas');
    }
};
