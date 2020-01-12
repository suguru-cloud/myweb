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

Route::group(['prefix' => 'admin', 'middleware' => 'check_role:admin'], function() {
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

Route::group(['prefix' => 'poster', 'middleware' => 'check_role:user'], function() {
  Route::get('photos/create', 'Poster\PhotoController@create'); //追記
  Route::post('photos', 'Poster\PhotoController@store'); //追記
  Route::get('photos', 'Poster\PhotoController@index'); //追記
  Route::get('photos/edit', 'Poster\PhotoController@edit'); //追記
  Route::post('photos/edit', 'Poster\PhotoController@update'); //追記
  Route::get('photos/delete', 'Poster\PhotoController@delete'); //追記
});

Route::get('/theaters', 'TheaterController@index')->name('theaters'); //追記

Route::get('/programs', 'ProgramController@index')->name('programs'); //追記

Route::get('/photos', 'PhotoController@index')->name('photos'); //追記

Route::get('/', 'TopController@index')->name('top'); //追記

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');//追記

