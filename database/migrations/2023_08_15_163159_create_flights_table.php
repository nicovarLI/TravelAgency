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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_city_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('destination_city_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('airline_id')->constrained()->cascadeOnDelete();
            $table->dateTime('departure_at');
            $table->dateTime('arrival_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
