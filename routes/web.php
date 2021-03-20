<?php

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
    return view('auth/login');
});

Route::resource('usuario', 'UserController');

Route::post('usuario/update', 'UserController@update')->name('usuario.update');

Route::get('usuario/destroy/{id}', 'UserController@destroy');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
