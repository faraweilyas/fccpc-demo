<?php

use Illuminate\Support\Facades\Route;

// Application
Route::prefix('application')
    ->name('application.')
    ->namespace('Backend')
    ->group(function()
    {
        Route::get(
            'select/{guest:tracking_id}',
            'ApplicationController@index'
        )
        ->name('index');

        Route::post(
            'create/{guest:tracking_id}/{action}',
            'ApplicationController@create'
        )
        ->name('create');

        Route::post(
            'upload/{id}',
            'ApplicationController@uploadNewCase'
        )
        ->name('create');

        Route::get(
            'upload/documents/{guest:tracking_id}',
            'ApplicationController@uploadDocuments'
        )
        ->name('upload');

        Route::get(
            'submitted/{guest:tracking_id}',
            'ApplicationController@applicationSubmitted'
        )
        ->name('submitted');

        Route::get(
            '{guest:tracking_id}/{case_category}',
            'ApplicationController@show'
        )
        ->name('show');
    });

// FAQ
Route::prefix('faq')
    ->name('faq.')
    ->namespace('Backend')
    ->middleware('auth')
    ->group(function()
    {
        Route::get(
            'create',
            'FaqController@create'
        )
        ->name('create');

        Route::post(
            'create',
            'FaqController@store'
        )
        ->name('create');

        Route::get(
            'edit/{faq}',
            'FaqController@edit'
        )
        ->name('edit');

        Route::post(
            'edit/{faq}',
            'FaqController@update'
        )
        ->name('update');

        Route::get(
            '/faqs',
            'FaqController@index'
        )
        ->name('faqs');

        Route::get(
            '/faqs/{faq}',
            'FaqController@destroy'
        )
        ->name('delete');
    });

// Enquiries
Route::group(['prefix' => 'enquiries', 'as' => 'enquiries.', 'namespace' => 'Backend'], function()
{
    Route::get('select',                'EnquiriesController@index')->name('index');
    Route::get('{type}',                'EnquiriesController@create')->name('create');
    Route::get('view/logs',             'EnquiriesController@logs')->name('logs')->middleware('auth');
    Route::get('assigned/handler/logs', 'EnquiriesController@assignedLogs')->name('assigned-logs')->middleware('auth');
    Route::post('assign/{id}',          'EnquiriesController@assignLog')->name('assign')->middleware('auth');
    Route::get('file/download/{file}',  'EnquiriesController@download')->name('download')->middleware('auth');
    Route::post('{type}',               'EnquiriesController@store')->name('create');
});

// Supervisor
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

// Cases
Route::group(['prefix' => 'cases', 'as' => 'cases.', 'namespace' => 'Backend'], function()
{
    Route::get('{type}',                 'CasesController@index')->name('index');
    Route::get('review/{id}',            'CasesController@reviewCase')->name('review');
    Route::post('assign/{id}',           'CasesController@assignCase')->name('assign');
    Route::post('update/{status}/{id}',  'CasesController@updateCaseStatus')->name('update_status');
});

// Case Handler
Route::group(['prefix' => 'handlers', 'as' => 'handlers.', 'namespace' => 'Backend'], function()
{
    Route::get('/',                          'CaseHandlersController@index')->name('index');
    Route::get('create',                     'CaseHandlersController@create')->name('create');
    Route::post('create',                    'CaseHandlersController@storeHandler')->name('store');
    Route::get('status/update/{id}',         'CaseHandlersController@updateHandlerStatus')->name('update_status');
    Route::get('view/{id}',                  'CaseHandlersController@show')->name('view');
});

