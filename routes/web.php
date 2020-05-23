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

//Base Controller
Route::get('/', 				'Frontend\HomeController@index')->name('home.index'); 
Route::get('/fee-calculator', 	'Frontend\HomeController@feeCalcutor')->name('home.calculator'); 
Route::get('/faq', 				'Frontend\HomeController@faq')->name('home.faq'); 

//Applicant Controller
Route::prefix('applicant')->group(function () {
	Route::get('dashboard/{id}', 	 'Backend\ApplicantController@index')->name('applicant.index');
	Route::post('authenticate', 	 'Backend\ApplicantController@authenticate')->name('applicant.authenticate');
	Route::get('submit', 			 'Backend\ApplicantController@submitApplication')->name('applicant.submit');
});

//Application Controller
Route::prefix('application')->group(function () {
	Route::get('select/{id}', 		 'Backend\ApplicationController@index')->name('application.index');
	Route::get('{type}/{id}', 		 'Backend\ApplicationController@create')->name('application.create');
});

//Supervisor Controller
Route::prefix('/')->group(function () {
	Route::get('dashboard', 	 'Backend\DashboardController@index')->name('dashboard');
});

//Cases Controller
Route::prefix('cases')->group(function () {
	Route::get('/{type}',		'Backend\CasesController@index')->name('cases.index');
	Route::get('/review/{id}',  'Backend\CasesController@show')->name('cases.review');
});

//Case Handler Controller
Route::prefix('handlers')->group(function () {
	Route::get('/',				'Backend\CaseHandlersController@index')->name('handlers.index');
	Route::get('/create',  		'Backend\CaseHandlersController@create')->name('handlers.create');
	Route::get('/view/{id}',  	'Backend\CaseHandlersController@show')->name('handlers.view');
});

//API Controller
Route::prefix('api')->group(function () {
	Route::post('application/create/{id}',	'Backend\ApplicationAuthController@createNewCase'); 
	Route::post('application/upload/{id}',	'Backend\ApplicationAuthController@uploadNewCase'); 
});
