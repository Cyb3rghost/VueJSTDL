<?php

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

Route::get('/tasksList/{q?}', 'TaskController@index');
Route::post('/addTask', 'TaskController@store');
Route::get('/tasks/edit/{id}', 'TaskController@edit');
Route::patch('/tasks/edit/{id}', 'TaskController@update');
Route::delete('/tasks/delete/{id}', 'TaskController@destroy');



Route::get('/', function () {
    return view('welcome');
});
