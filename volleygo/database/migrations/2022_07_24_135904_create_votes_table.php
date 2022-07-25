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
        Schema::create('votes', function (Blueprint $table) {
            $table->bigIncrements('id_vote');
            //foraneidad con usuario
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users');
            //foraneidad con campeonato
            $table->unsignedBigInteger('id_championship');
            $table->foreign('id_championship')->references('id_championship')->on('championships');
            //foraneidad con team_players
            $table->unsignedBigInteger('id_tp_cen1');
            $table->foreign('id_tp_cen1')->references('id_team_player')->on('team_players');
            $table->unsignedBigInteger('id_tp_cen2');
            $table->foreign('id_tp_cen2')->references('id_team_player')->on('team_players');
            $table->unsignedBigInteger('id_tp_ops1');
            $table->foreign('id_tp_ops1')->references('id_team_player')->on('team_players');
            $table->unsignedBigInteger('id_tp_ops2');
            $table->foreign('id_tp_ops2')->references('id_team_player')->on('team_players');
            $table->unsignedBigInteger('id_tp_opo');
            $table->foreign('id_tp_opo')->references('id_team_player')->on('team_players');
            $table->unsignedBigInteger('id_tp_set');
            $table->foreign('id_tp_set')->references('id_team_player')->on('team_players');
            $table->unsignedBigInteger('id_tp_lib');
            $table->foreign('id_tp_lib')->references('id_team_player')->on('team_players');
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
        Schema::dropIfExists('votes');
    }
};
