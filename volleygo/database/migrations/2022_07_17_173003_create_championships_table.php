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
        Schema::create('championships', function (Blueprint $table) {
            $table->bigIncrements('id_championship');
            $table->string('name');
            $table->string('description', 1000);
            //foraneidad con usuario
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->string('departament');
            $table->string('city');
            $table->string('direction');
            $table->boolean('cash');
            $table->boolean('transfer');
            $table->boolean('online');
            $table->boolean('abitab_redpagos');
            $table->boolean('beach');
            $table->integer('max_teams')->unsigned();
            $table->dateTime('datetime');
            $table->boolean('group_stage');
            $table->string('competition_format');
            $table->integer('sets');
            $table->integer('final_sets');
            $table->integer('points');
            $table->integer('final_points');
            $table->boolean('gold_cup');
            $table->boolean('silver_cup');
            $table->boolean('bronce_cup');
            $table->boolean('participation_reward');
            $table->string('gender');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('championships');
    }
};
