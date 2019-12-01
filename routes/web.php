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
  Route::get('theater/create', 'Admin\TheaterController@add'); //追記
  Route::post('theater/create', 'Admin\TheaterController@create'); //追記
  Route::get('theater', 'Admin\TheaterController@index'); //追記
  Route::get('theater/edit', 'Admin\TheaterController@edit'); //追記
  Route::post('theater/edit', 'Admin\TheaterController@update'); //追記
  Route::get('theater/delete', 'Admin\TheaterController@delete'); //追記
  Route::get('program/create', 'Admin\ProgramController@add'); //追記
  Route::post('program/create', 'Admin\ProgramController@create'); //追記
  Route::get('profile/create', 'Admin\ProfileController@add');
  Route::post('profile/create', 'Admin\ProfileController@create');
  Route::get('profile', 'Admin\ProfileController@index');//追記
  Route::get('profile/edit', 'Admin\ProfileController@edit');
  Route::post('profile/edit', 'Admin\ProfileController@update');
  Route::get('profile/delete', 'Admin\ProfileController@delete');
});

Route::get('/theater', 'TheaterController@index');//追記

Route::get('/profile', 'ProfileController@index');

Auth::routes();

Route::get('/top', 'TopController@index')->name('top');//追記

