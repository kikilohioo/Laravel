<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChampionshipRequest;
use App\Models\Championship;
use App\Models\ChampionshipTeam;
use App\Models\TeamPlayer;

class ChampionshipController extends Controller
{
    //Controlador de Campeonatos
    public function __construct()
    {
        //$this->middleware('auth')->except('index');
    }

    public function index () {
        //mostrar todos los campeonatos
        $id_user = request()->input('id_user');

        $championships = [
            'self_managed' => [],
            'as_player' => []
        ];

        if(isset($id_user)){
            //carga de campeonatos creados por mi
            $championships['self_managed'] = Championship::where('id_user', $id_user)->get()->toArray();
            
            //carga de campeonatos en los que participé
            $teams_as_player = TeamPlayer::where('id_user', $id_user)->get();
            
            if(isset($teams_as_player)){
                $championships_by_teams = [];
                
                foreach($teams_as_player as $team){
                    $championship_by_team = ChampionshipTeam::where('id_team', $team->id_team)->get('id_championship')->toArray();
                    foreach($championship_by_team as $championship){
                        array_push($championships_by_teams, $championship['id_championship']);
                    }
                }

                foreach($championships_by_teams as $championship){
                    array_push($championships['as_player'], Championship::find($championship)->toArray());
                }
                
                return $championships;
            }
        }
        
        $championships = Championship::all()->toArray();
        
        return $championships;
    }

    public function show(Championship $championship) {
        //mostrar un campeonato
        //$championship = Championship::findOrFail($championship); se resuelve con herencia en el parametro
        
        return $championship;
    }

    public function store(ChampionshipRequest $request) {
        //crear un campeonato
        // $validator = Validator::make($request->all(), $rules);
        // //validacion de los datos recibidos
        // if($validator->fails()){
        //     return response("Field validation failed", 400);
        // }
        $newChampionship = new Championship();
        
        $newChampionship->name = $request->name;
        $newChampionship->description = $request->description;
        $newChampionship->id_user = $request->id_user;
        $newChampionship->departament = $request->departament;
        $newChampionship->city = $request->city;
        $newChampionship->direction = $request->direction;
        $newChampionship->cash = $request->cash;
        $newChampionship->transfer = $request->transfer;
        $newChampionship->online = $request->online;
        $newChampionship->abitab_redpagos = $request->abitab_redpagos;
        $newChampionship->beach = $request->beach;
        $newChampionship->max_teams = $request->max_teams;
        $newChampionship->datetime = $request->datetime;
        $newChampionship->group_stage = $request->group_stage;
        $newChampionship->competition_format = $request->competition_format;
        $newChampionship->sets = $request->sets;
        $newChampionship->final_sets = $request->final_sets;
        $newChampionship->points = $request->points;
        $newChampionship->final_points = $request->final_points;
        $newChampionship->gold_cup = $request->gold_cup;
        $newChampionship->silver_cup = $request->silver_cup;
        $newChampionship->bronce_cup = $request->bronce_cup;
        $newChampionship->participation_reward = $request->participation_reward;
        $newChampionship->gender = $request->gender;
        
        $newChampionship->save();

        return $newChampionship;
    }

    public function update(ChampionshipRequest $request, Championship $championship) {
        //actualizar un campeonato
        // $validator = Validator::make($request->all(), $rules);
        // //validacion de los datos recibidos
        // if($validator->fails()){
        //     return response("Field validation failed", 400);
        // }
        //$championship = Championship::findOrFail($championship);
        
        $championship->update($request->validated());

        return $championship;
    }

    public function destroy(Championship $championship) {
        //eliminar un campeonato
        //$championship = Championship::findOrFail($championship);
        
        $championship->delete();

        return $championship;
    }
}
