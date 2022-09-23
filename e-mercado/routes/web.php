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

Route::get('profile', 'ProfileController@edit')->name('profile.edit')->middleware(['auth']);
Route::put('profile', 'ProfileController@update')->name('profile.update');

//PayPal endpoints
Route::post('paypal', 'PaypalPaymentController@pay')->name('paypal.pay');
Route::get('paypal/success', 'PaypalPaymentController@success')->name('paypal.success');
Route::get('paypal/error', 'PaypalPaymentController@error')->name('paypal.error');

//dlocal endpoints
Route::post('dlocal', 'DlocalPaymentController@pay')->name('dlocal.pay');
Route::get('dlocal/success', 'DlocalPaymentController@success')->name('dlocal.success');
Route::get('dlocal/pending', 'DlocalPaymentController@pending')->name('dlocal.pending');
Route::get('dlocal/refunds', 'DlocalPaymentController@refunds')->name('dlocal.refunds');

//Faltan los Mercado Pago endpoints

Route::resource('products.carts', 'ProductCartController')->only(['destroy', 'store']);
Route::resource('orders.payments', 'OrderPaymentController')->only(['create', 'store'])->middleware(['verified']);
Route::resource('carts', 'CartController')->only(['index']);
Route::resource('orders', 'OrderController')->middleware([
    'verified',
    //'reset' para que no se puedan resetear las contraseñas
]);

Auth::routes([
    'verify' => true
]);