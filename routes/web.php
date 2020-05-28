<?php

use App\Enhancers\Asset;
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
	Route::get('track', 			 'Backend\ApplicantController@trackApplication')->name('applicant.track');
	Route::post('track', 	 		 'Backend\ApplicantController@authenticateTrack')->name('applicant.authenticate_track');
});

//Application Controller
Route::prefix('application')->group(function () {
	Route::get('select/{id}', 		 'Backend\ApplicationController@index')->name('application.index');
	Route::get('{type}/{id}', 		 'Backend\ApplicationController@create')->name('application.create');
});

//Supervisor Controller
Route::prefix('/')->group(function () {
	Route::get('dashboard', 	 				 'Backend\DashboardController@index')->name('dashboard');
	Route::get('user/create', 	 				 'Backend\DashboardController@createUser')->name('dashboard.create_user');
	Route::post('user/create', 	 				 'Backend\DashboardController@storeUser')->name('dashboard.user_store');
	Route::get('users', 	     				 'Backend\DashboardController@viewUsers')->name('dashboard.users');
	Route::get('users/status/update/{id}', 	     'Backend\DashboardController@updateUserStatus')->name('dashboard.update_users_status');
	Route::get('profile', 	     				 'Backend\DashboardController@viewProfile')->name('dashboard.profile');
	Route::post('profile', 	     				 'Backend\DashboardController@updateProfile')->name('dashboard.update_user');
});

//Cases Controller
Route::prefix('cases')->group(function () {
	Route::get('{type}',				 'Backend\CasesController@index')->name('cases.index');
	Route::get('review/{id}',   		 'Backend\CasesController@reviewCase')->name('cases.review'); 
	Route::post('assign/{id}',  		 'Backend\CasesController@assignCase')->name('cases.assign'); 
	Route::post('update/{status}/{id}',   'Backend\CasesController@updateCaseStatus')->name('cases.update_status'); 
});

//Case Handler Controller
Route::prefix('handlers')->group(function () {
	Route::get('/',							 'Backend\CaseHandlersController@index')->name('handlers.index');
	Route::get('create',  					 'Backend\CaseHandlersController@create')->name('handlers.create');
	Route::post('create',  					 'Backend\CaseHandlersController@storeHandler')->name('handlers.store');
	Route::get('status/update/{id}', 	     'Backend\CaseHandlersController@updateHandlerStatus')->name('handler.update_status');
	Route::get('view/{id}',  				 'Backend\CaseHandlersController@show')->name('handlers.view');
});

//API Controller
Route::prefix('api')->group(function () {
	Route::post('application/create/{id}',	'Backend\ApplicationAuthController@createNewCase');
	Route::post('application/upload/{id}',	'Backend\ApplicationAuthController@uploadNewCase');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
