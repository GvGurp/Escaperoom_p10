<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relates to the users table
            $table->integer('level_id');
            $table->integer('points'); // Stores calculated points
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
