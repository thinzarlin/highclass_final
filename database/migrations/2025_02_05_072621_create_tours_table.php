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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('en_name');
            $table->string('mm_name');
            $table->string('short_name');
            $table->enum('route_type', ['in', 'out'])->default('out');
            $table->text('remark')->nullable();
            $table->nestedSet();
            $table->foreignId('out_tour_id')->nullable()->constrained('tours')->nullOnDelete();
            $table->foreignId('in_tour_id')->nullable()->constrained('tours')->nullOnDelete();
            $table->boolean('current')->default(true);
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
        Schema::dropIfExists('tours');
    }
};
