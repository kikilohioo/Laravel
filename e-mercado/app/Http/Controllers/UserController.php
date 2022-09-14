<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    //Controlador de usuarios
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        //
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
