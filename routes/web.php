<?php

use Illuminate\Support\Facades\Route;

// Base Controller
Route::group(['prefix' => '/', 'as' => 'home.', 'namespace' => 'Frontend'], function()
{
    Route::get('/',                               'HomeController@index')->name('index');
    Route::get('/fee-calculator',                 'HomeController@feeCalcutor')->name('calculator');
    Route::get('/faq/en/{type?}',                 'HomeController@faq')->name('faq');
    Route::get('/faq/view/{id}',                  'HomeController@faqDetails')->name('faq.details');
    Route::get('/faq/feedback/{id}/{question}',   'HomeController@updateFaqFeedback')->name('faq.feedback');
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
Route::group(['prefix' => 'application', 'as' => 'application.', 'namespace' => 'Backend', 'middleware' => 'validate.tracking_id'], function()
{
    Route::get('select/{id}',           'ApplicationController@index')->name('index');
    Route::get('success/{id}',          'ApplicationController@applicationSuccess')->name('success');
    Route::get('{type}/{id}',           'ApplicationController@create')->name('create');
    Route::get('upload/documents/{id}', 'ApplicationController@supportingDocuments')->name('upload');

});

// FAQ Controller
Route::group(['prefix' => 'faq', 'as' => 'faq.', 'namespace' => 'Backend'], function()
{
    Route::get('create',             'FaqController@index')->name('index');
    Route::post('create',            'FaqController@store')->name('create');
    Route::get('edit/{id}',           'FaqController@edit')->name('edit');
    Route::post('edit/{id}',          'FaqController@update')->name('edit');
    Route::get('/logs',               'FaqController@logs')->name('logs');
    Route::get('/logs/{id}',          'FaqController@destroy')->name('destroy');
});

// Enquiries Controller
Route::group(['prefix' => 'enquiries', 'as' => 'enquiries.', 'namespace' => 'Backend'], function()
{
    Route::get('select',                'EnquiriesController@index')->name('index');
    Route::get('{type}',                'EnquiriesController@create')->name('create');
    Route::get('view/logs',                  'EnquiriesController@logs')->name('logs')->middleware('auth');
    Route::get('assigned/handler/logs', 'EnquiriesController@assignedLogs')->name('assigned-logs')->middleware('auth');
    Route::post('assign/{id}',          'EnquiriesController@assignLog')->name('assign')->middleware('auth');
    Route::get('file/download/{file}',  'EnquiriesController@download')->name('download')->middleware('auth');
    Route::post('{type}',               'EnquiriesController@store')->name('create');
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
    Route::get('/',                          'CaseHandlersController@index')->name('index');
    Route::get('create',                     'CaseHandlersController@create')->name('create');
    Route::post('create',                    'CaseHandlersController@storeHandler')->name('store');
    Route::get('status/update/{id}',         'CaseHandlersController@updateHandlerStatus')->name('update_status');
    Route::get('view/{id}',                  'CaseHandlersController@show')->name('view');
});

Auth::routes();
