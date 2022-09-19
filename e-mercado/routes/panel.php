<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'PanelController@index')->name('panel');
Route::get('users', 'UserController@index')->name('users.index');
Route::post('users/admin/{user}', 'UserController@toggleAdmin')->name('users.admin.toggle');
Route::resource('products', 'ProductController');