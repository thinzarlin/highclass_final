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
        Schema::create('cb_records', function (Blueprint $table) {
            $table->id();
            $table->integer('ref_no')->unique();
            $table->date('date');
            $table->integer('line_no');
            $table->foreignId('coa_id')->constrained('coas')->restrictOnDelete();
            $table->text('remark')->nullable();
            $table->integer('debit')->default(0);
            $table->integer('credit')->default(0);
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
        Schema::dropIfExists('cb_records');
    }
};
