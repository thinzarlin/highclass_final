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
        Schema::create('coa_sub_headings', function (Blueprint $table) {
            $table->id();
            $table->integer('start_code');
            $table->integer('end_code');
            $table->string('name');
            $table->foreignId('main_heading_id')->constrained('coa_main_headings')->restrictOnDelete();
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
        Schema::dropIfExists('coa_sub_headings');
    }
};
