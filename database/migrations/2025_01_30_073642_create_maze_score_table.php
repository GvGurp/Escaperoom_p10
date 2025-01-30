<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
    Schema::create('maze_scores', function (Blueprint $table) {
        $table->id();
        $table->string('username'); // Spelernaam
        $table->integer('moves'); // Aantal zetten
        $table->integer('difficulty'); // Moeilijkheidsgraad (bijv. 10, 15, 25)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maze_scores');
    }
};
