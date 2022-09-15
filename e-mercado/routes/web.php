<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@index')->name('main');

Route::resource('products.carts', 'ProductCartController')->only(['destroy', 'store']);
Route::resource('orders.payments', 'OrderPaymentController')->only(['create', 'store']);
Route::resource('carts', 'CartController')->only(['index']);
Route::resource('orders', 'OrderController');

Auth::routes();