<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use App\Models\TeamPlayer;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //Controlador de Campeonatos
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index () {
        //mostrar todos los equipos
        $id_user = request()->input('id_user');
        $teams = Team::where('id_user', $id_user)->get();
        
        return $teams;
    }

    public function show(Team $team) {
        //mostrar un equipo        
        return $team;
    }

    public function store(TeamRequest $request) {
        //crear un equipo
        $team = Team::create($request->validated());
        
        return $team;
    }

    public function update(TeamRequest $request, Team $team) {
        //actualizar un equipo
        $team->update($request->validated());
        
        return $team;
    }
    
    public function destroy(Team $team) {
        //eliminamos un equipo
        $team->delete();

        return $team;
    }
}
