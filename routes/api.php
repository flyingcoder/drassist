<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api']], function () {
	Route::get('patients', 'PatientController@index');
	Route::post('patients', 'PatientController@store');
	Route::post('records/{id}', 'PatientController@newRecords');
	Route::delete('patients/{id}', 'PatientController@deletePatient');
	Route::delete('records/{id}', 'PatientController@deleteRecord');
	Route::delete('contact/{id}', 'PatientController@deleteContact');
});





