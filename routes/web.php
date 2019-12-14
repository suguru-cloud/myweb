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
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
  Route::get('theaters/create', 'Admin\TheaterController@create'); //追記
  Route::post('theaters', 'Admin\TheaterController@store'); //追記
  Route::get('theaters', 'Admin\TheaterController@index'); //追記
  Route::get('theaters/edit', 'Admin\TheaterController@edit'); //追記
  Route::post('theaters/edit', 'Admin\TheaterController@update'); //追記
  Route::get('theater/delete', 'Admin\TheaterController@delete'); //追記
  Route::get('programs/create', 'Admin\ProgramController@create'); //追記
  Route::post('programs', 'Admin\ProgramController@store'); //追記
  Route::get('programs', 'Admin\ProgramController@index'); //追記
  Route::get('programs/edit', 'Admin\ProgramController@edit'); //追記
  Route::post('programs/edit', 'Admin\ProgramController@update'); //追記
  Route::get('programs/delete', 'Admin\ProgramController@delete'); //追記
});

Route::group(['prefix' => 'poster', 'middleware' => 'auth'], function() {
  Route::get('photo/create', 'Poster\PhotoController@add'); //追記
  Route::post('photo/create', 'Poster\PhotoController@create'); //追記
});

Route::get('/theater', 'TheaterController@index');//追記

Route::get('/profile', 'ProfileController@index');

Auth::routes();

Route::get('/top', 'TopController@index')->name('top');//追記

