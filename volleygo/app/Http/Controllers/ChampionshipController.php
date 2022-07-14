<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChampionshipController extends Controller
{
    //Controlador de Campeonatos

    public function index () {
        return 'Esta es la lista de campeonatos';
    }

    public function show($id) {
        return 'Campeonato con id: '.$id;
    }

    public function create() {
        //
    }

    public function update($id) {
        //
    }

    public function delete($id) {
        //
    }
}
