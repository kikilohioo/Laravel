<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return "VolleyGO API v".env('APP_VERSION');
})->name('main');

//endpoint para gestionar CRUD campeonatos
Route::resource('championship', 'ChampionshipController')->except(['edit','create']);

//endpoint para gestionar CRUD usuarios
Route::resource('user', 'UserController')->except(['edit','create']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
