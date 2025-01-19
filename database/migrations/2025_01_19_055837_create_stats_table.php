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
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players')->onDelete('cascade'); 
            $table->foreignId('match_id')->constrained('matches')->onDelete('cascade'); 
            $table->integer('goals')->default(0); 
            $table->integer('assists')->default(0);
            $table->integer('yellow_cards')->default(0); 
            $table->integer('red_cards')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stats');
    }
};
