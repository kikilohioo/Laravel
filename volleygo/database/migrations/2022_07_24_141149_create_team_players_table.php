<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_players', function (Blueprint $table) {
            $table->bigIncrements('id_team_player');
            //foraneidad con player
            $table->unsignedBigInteger('id_player');
            $table->foreign('id_player')->references('id_player')->on('players')->onDelete('cascade');
            //foraneidad con team
            $table->unsignedBigInteger('id_team');
            $table->foreign('id_team')->references('id_team')->on('teams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_players');
    }
};
