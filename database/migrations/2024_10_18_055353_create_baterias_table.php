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
        Schema::create('baterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surfista1_id')->constrained('surfistas');
            $table->foreignId('surfista2_id')->constrained('surfistas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baterias');
    }
};
