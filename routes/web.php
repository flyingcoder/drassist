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


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::post('custom-form', 'ExternalFormController@store');

Route::get('custom-form', 'ExternalFormController@store');

Route::get('/', 'HomeController@status');
