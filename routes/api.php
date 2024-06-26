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


Route::group(['middleware' => ['auth:api']], function () {

	Route::group(['prefix' => 'bookings'], function () {
		Route::get('/', 'ExternalFormController@getBookings');
		Route::get('/{id}', 'ExternalFormController@getBooking');
	});
	
	Route::group(['prefix' => 'user'], function () {
		Route::get('/', 'UserController@getUser');
		Route::post('payments', 'UserController@postPaymentMethods');
		Route::get('payment-methods', 'UserController@getPaymentMethods');
		Route::post('remove-payment', 'UserController@removePaymentMethod');
	});

	Route::group(['prefix' => 'credits'], function () {
		Route::post('/', 'UserController@buyCredits');
		Route::get('/', 'UserController@getCredits');
	});
	
	
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
		Route::post('{id}/upload', 'MedRecController@uploadRecord');
		Route::get('{id}', 'MedRecController@getRecord');
		Route::delete('{id}', 'MedRecController@deleteRecord');
	});

	Route::group(['prefix' => 'contacts'], function () {
		Route::delete('{id}', 'ContactController@deleteContact');
		Route::get('{id}', 'ContactController@getContacts');
		Route::post('/', 'ContactController@store');
		Route::post('{id}', 'ContactController@updateContact');
	});

	Route::group(['prefix' => 'cards'], function () {
		Route::post('/', 'MedRecController@uploadCard');
	});
});





