<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //Controlador de usuarios
    public function __construct()
    {
        //$this->middleware('auth')->except('index');
    }

    public function index()
    {
        //mostrar todos los usuarios
        $users = User::all()->toArray();

        return $users;
    }

    public function show(User $user)
    {
        //mostrar un campeonato
        //$user = user::findOrFail($user); se resuelve con herencia en el parametro

        return $user;
    }

    /**
     * Crear un nuevo campeonato
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        dd($request);
        $validated = $request->validated();

        $newUser = new User();

        $newUser->names = $validated('names');
        $newUser->lastnames = $validated('lasnames');
        $newUser->email = $validated('email');
        $newUser->password = Hash::make($validated('password'));
        $newUser->DNI = $validated('DNI');
        $newUser->DNI_type = $validated('DNI_type');
        $newUser->phone = $validated('phone');
        $newUser->gender = $validated('gender');
        $newUser->position = $validated('position');
        $newUser->number = $validated('number');

        $newUser->save();

        return $newUser;
    }

    public function update(UserRequest $request, User $user)
    {
        //actualizar un campeonato
        // $validator = Validator::make($request->all(), $rules);
        // //validacion de los datos recibidos
        // if($validator->fails()){
        //     return response("Field validation failed", 400);
        // }
        //$user = user::findOrFail($user);

        $user->update($request->validated());

        return $user;
    }

    public function destroy(User $user)
    {
        //eliminar un campeonato
        //$user = user::findOrFail($user);

        $user->delete();

        return $user;
    }
}
