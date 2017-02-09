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

Route::post('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::post('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('/', ['as' => 'home', 'uses' => 'AdController@index']);
Route::get('/edit', ['as' => 'create_ad', 'uses' => 'AdController@create']);
Route::get('/{id}', ['as' => 'show_ad', 'uses' => 'AdController@show']);
Route::get('/edit/{id}', ['as' => 'edit_ad', 'uses' => 'AdController@edit']);
Route::post('/store', ['as' => 'store', 'uses' => 'AdController@store']);
Route::put('/edit/{id}', ['as' => 'update_ad', 'uses' => 'AdController@update']);
Route::delete('/delete/{id}', ['as' => 'delete_ad', 'uses' => 'AdController@destroy']);
