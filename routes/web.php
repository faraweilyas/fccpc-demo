<?php

use App\Enhancers\Asset;
use Illuminate\Support\Facades\Route;

// Base Controller
Route::group(['prefix' => '/', 'as' => 'home.', 'namespace' => 'Frontend'], function()
{
    Route::get('/',               'HomeController@index')->name('index');
    Route::get('/fee-calculator', 'HomeController@feeCalcutor')->name('calculator');
    Route::get('/faq',            'HomeController@faq')->name('faq');
});

// Applicant Controller
Route::group(['prefix' => 'applicant', 'as' => 'applicant.', 'namespace' => 'Backend'], function()
{
    Route::post('authenticate',      'ApplicantController@authenticate')->name('authenticate');
    Route::get('submit',             'ApplicantController@submitApplication')->name('submit');
    Route::get('track',              'ApplicantController@trackApplication')->name('track');
    Route::post('track',             'ApplicantController@authenticateTrack')->name('authenticate_track');
});

// Application Controller
Route::group(['prefix' => 'application', 'as' => 'application.', 'namespace' => 'Backend', 'middleware' => 'ValidateTrackingId'], function()
{
    Route::get('select/{id}',           'ApplicationController@index')->name('index');
    Route::get('{type}/{id}',           'ApplicationController@create')->name('create');
    Route::get('upload/documents/{id}', 'ApplicationController@supportingDocuments')->name('upload');
    Route::get('success/{id}',          'ApplicationController@applicationSuccess')->name('success');
});

// Enquiries Controller
Route::group(['prefix' => 'enquiries', 'as' => 'enquiries.', 'namespace' => 'Backend', 'middleware' => 'ValidateTrackingId'], function()
{
    Route::get('select/{id}',   'EnquiriesController@index')->name('index');
    Route::get('{type}/{id}',   'EnquiriesController@create')->name('create');
    Route::get('track',    'EnquiriesController@trackEnquiry')->name('track')->withoutMiddleware(['ValidateTrackingId']);
    Route::post('track',   'EnquiriesController@authenticateTrackEnquiry')->name('track')->withoutMiddleware(['ValidateTrackingId']);
});
// Supervisor Controller
Route::group(['prefix' => '/', 'as' => 'dashboard.', 'namespace' => 'Backend'], function()
{
    Route::get('dashboard',                'DashboardController@index')->name('index');
    Route::get('user/create',              'DashboardController@createUser')->name('create_user');
    Route::post('user/create',             'DashboardController@storeUser')->name('user_store');
    Route::get('users',                    'DashboardController@viewUsers')->name('users');
    Route::get('users/status/update/{id}', 'DashboardController@updateUserStatus')->name('update_users_status');
    Route::get('profile',                  'DashboardController@viewProfile')->name('profile');
    Route::post('profile',                 'DashboardController@updateProfile')->name('update_user');
});

// Cases Controller
Route::group(['prefix' => 'cases', 'as' => 'cases.', 'namespace' => 'Backend'], function()
{
    Route::get('{type}',                 'CasesController@index')->name('index');
    Route::get('review/{id}',            'CasesController@reviewCase')->name('review');
    Route::post('assign/{id}',           'CasesController@assignCase')->name('assign');
    Route::post('update/{status}/{id}',  'CasesController@updateCaseStatus')->name('update_status');
});

// Case Handler Controller
Route::group(['prefix' => 'handlers', 'as' => 'handlers.', 'namespace' => 'Backend'], function()
{
    Route::get('/',                          'Backend\CaseHandlersController@index')->name('index');
    Route::get('create',                     'Backend\CaseHandlersController@create')->name('create');
    Route::post('create',                    'Backend\CaseHandlersController@storeHandler')->name('store');
    Route::get('status/update/{id}',         'Backend\CaseHandlersController@updateHandlerStatus')->name('update_status');
    Route::get('view/{id}',                  'Backend\CaseHandlersController@show')->name('view');
});

Auth::routes();
