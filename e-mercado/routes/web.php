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
    return "e-Mercado API v".env('APP_VERSION');
})->name('main');

Route::resource('products', 'ProductController')->except(['edit', 'create']);
Route::resource('products.carts', 'ProductCartController')->only(['destroy', 'store', 'update']);
Route::resource('carts', 'CartController')->only(['index']);

Auth::routes();
