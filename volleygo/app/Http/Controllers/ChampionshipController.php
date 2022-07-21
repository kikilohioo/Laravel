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
        $rules = [
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'id_user' => ['required'],
            'departament' => ['required'],
            'city' => ['required'],
            'direction' => ['required'],
            'cash' => ['required'],
            'transfer' => ['required'],
            'online' => ['required'],
            'abitab_redpagos' => ['required'],
            'beach' => ['required'],
            'max_teams' => ['required'],
            'datetime' => ['required'],
            'group_stage' => ['required'],
            'competition_format' => ['required'],
            'sets' => ['required','min:1'],
            'final_sets' => ['required'],
            'points' => ['required','min:1'],
            'final_points' => ['required'],
            'gold_cup' => ['required'],
            'silver_cup' => ['required'],
            'bronce_cup' => ['required'],
            'participation_reward' => ['required'],
            'gender' => ['required','in:MIX,MAS,FEM']
        ];

        //validacion de los datos recibidos
        request()->validate($rules);

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
        $championship = Championship::findOrFail($id);
        
        $championship->update(request()->all());

        return $championship;
    }

    public function delete($id) {
        //eliminar un campeonato
        $championship = Championship::findOrFail($id);
        
        $championship->delete();

        return $championship;
    }
}
