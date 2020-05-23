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
	Route::get('/dashboard/{id}', 	 'Backend\ApplicantController@index')->name('applicant.index');
	Route::get('/submit', 			 'Backend\ApplicantController@submitApplication')->name('applicant.submit');
	Route::get('/select/{id}', 		 'Backend\ApplicantController@selectApplication')->name('applicant.select');
});