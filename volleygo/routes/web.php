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

Route::resource('championships', 'ChampionshipController')->except(['edit','create']);
//endpoint para mostrar todos los campeonatos
// Route::get('championships', 'ChampionshipController@index')->name('championships.index');

// //endpoint para crear campeonato
// Route::post('championships', 'ChampionshipController@create')->name('championships.create');

// //endpoint para mostrar campeonato
// Route::get('championships/{id}', 'ChampionshipController@show')->name('championships.show');

// //endpoint para actualizar campeonato
// /* Otra forma seria Route::match(['put'], 'ruta', function () {...}) */
// Route::put('championships/{id}','ChampionshipController@update')->name('championships.update');

// //endpoint para eliminar campeonato
// Route::delete('championships/{id}', 'ChampionshipController@delete')->name('championships.delete');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
