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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_team_id')->constrained('teams')->onDelete('cascade'); 
            $table->foreignId('away_team_id')->constrained('teams')->onDelete('cascade'); 
            $table->date('match_date'); 
            $table->time('match_time'); 
            $table->string('location'); 
            $table->double('guarantee')->nullable(); 
            $table->enum('status', ['scheduled', 'played', 'cancelled']); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
