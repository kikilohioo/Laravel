<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use Illuminate\Http\Request;

class ChampionshipController extends Controller
{
    //Controlador de Campeonatos

    public function index () {
        //mostrar todos los campeonatos
        $championships = Championship::all();
        return $championships;
    }

    public function show($id) {
        //mostrar un campeonato
        $championship = Championship::findOrFail($id);
        return $championship;
    }

    public function create() {
        //crear un campeonato
        $newChampionship = new Championship();
        $newChampionship->name = request()->name;
        $newChampionship->description = request()->description;
        $newChampionship->id_user = request()->id_user;
        $newChampionship->departament = request()->departament;
        $newChampionship->city = request()->city;
        $newChampionship->direction = request()->direction;
        $newChampionship->cash = request()->cash;
        $newChampionship->transfer = request()->transfer;
        $newChampionship->online = request()->online;
        $newChampionship->abitab_redpagos = request()->abitab_redpagos;
        $newChampionship->beach = request()->beach;
        $newChampionship->max_teams = request()->max_teams;
        $newChampionship->datetime = request()->datetime;
        $newChampionship->group_stage = request()->group_stage;
        $newChampionship->competition_format = request()->competition_format;
        $newChampionship->sets = request()->sets;
        $newChampionship->final_sets = request()->final_sets;
        $newChampionship->points = request()->points;
        $newChampionship->final_points = request()->final_points;
        $newChampionship->gold_cup = request()->gold_cup;
        $newChampionship->silver_cup = request()->silver_cup;
        $newChampionship->bronce_cup = request()->bronce_cup;
        $newChampionship->participation_reward = request()->participation_reward;
        $newChampionship->gender = request()->gender;
        $newChampionship->save();

        return $newChampionship;
    }

    public function update($id) {
        //actualizar un campeonato
    }

    public function delete($id) {
        //eliminar un campeonato
    }
}
