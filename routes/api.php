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
	
	Route::group(['prefix' => 'patients'], function () {
		Route::get('/', 'PatientController@index');
		Route::post('/', 'PatientController@store');
		Route::post('{id}/records', 'MedRecController@newRecords');
		Route::get('{id}/records', 'MedRecController@records');
		Route::delete('{id}', 'PatientController@deletePatient');
		Route::post('{id}', 'PatientController@updatePatient');
		Route::get('{id}', 'PatientController@getPatient');
	});
	
	Route::group(['prefix' => 'records'], function () {
		Route::post('{id}', 'MedRecController@updateRecord');
		Route::get('{id}', 'MedRecController@getRecord');
		Route::delete('{id}', 'MedRecController@deleteRecord');
	});

	Route::delete('contact/{id}', 'PatientController@deleteContact');
});





