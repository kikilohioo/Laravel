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
        Schema::create('championship_teams', function (Blueprint $table) {
            $table->bigIncrements('id_championship_team');
            //foraneidad con teams
            $table->unsignedBigInteger('id_team');
            $table->foreign('id_team')->references('id_team')->on('teams')->onDelete('cascade');
            //foraneidad con championship
            $table->unsignedBigInteger('id_championship');
            $table->foreign('id_championship')->references('id_championship')->on('championships')->onDelete('cascade');
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
        Schema::dropIfExists('championship_teams');
    }
};
