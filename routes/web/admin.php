<?php

use Illuminate\Support\Facades\Route;

// Application
Route::prefix('application')
    ->name('application.')
    ->namespace('Backend')
    ->group(function () {
        Route::get(
            'select/{guest:tracking_id}',
            'ApplicationController@index'
        )->name('index');

        Route::post(
            'create/{guest:tracking_id}/{action}',
            'ApplicationController@create'
        )->name('create');

        Route::post(
            'submit/{guest:tracking_id}',
            'ApplicationController@submit'
        )->name('submit');

        Route::get(
            'submitted/{guest:tracking_id}',
            'ApplicationController@applicationSubmitted'
        )->name('submitted');

        Route::get(
            'upload/documents/{guest:tracking_id}',
            'ApplicationController@uploadDocuments'
        )->name('upload');

        Route::get(
            '{guest:tracking_id}/{case_category}',
            'ApplicationController@show'
        )->name('show');

        Route::get(
            '/applicant/{guest:tracking_id}/review',
            'ApplicationController@review'
        )->name('review');
    });

// Enquiries
Route::prefix('enquiries')
    ->name('enquiries.')
    ->namespace('Backend')
    ->group(function () {
        Route::get('select', 'EnquiriesController@index')->name('index');

        Route::get('all', 'EnquiriesController@logs')
            ->name('logs')
            ->middleware('auth');

        Route::get('assigned/handler/logs', 'EnquiriesController@assignedLogs')
            ->name('assigned-logs')
            ->middleware('auth');

        Route::post('assign/{id}', 'EnquiriesController@assignLog')
            ->name('assign')
            ->middleware('auth');

        Route::get('file/download/{file}', 'EnquiriesController@download')
            ->name('download')
            ->middleware('auth');

        Route::get('{type}', 'EnquiriesController@create')->name('create');

        Route::post('/', 'EnquiriesController@store')->name('store');
    });

// FAQ
Route::prefix('faq')
    ->name('faq.')
    ->namespace('Backend')
    ->middleware('auth')
    ->group(function () {
        Route::get('create', 'FaqController@create')->name('create');

        Route::post('create', 'FaqController@store')->name('create');

        Route::get('edit/{faq}', 'FaqController@edit')->name('edit');

        Route::post('edit/{faq}', 'FaqController@update')->name('update');

        Route::get('all', 'FaqController@index')->name('faqs');

        Route::get('faq/{faq}', 'FaqController@destroy')->name('delete');
    });

// User
Route::prefix('/')
    ->name('dashboard.')
    ->namespace('Backend')
    ->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('index');

        Route::get('user/create', 'DashboardController@createUser')->name(
            'create_user'
        );

        Route::post('user/create', 'DashboardController@storeUser')->name(
            'user_store'
        );

        Route::get('users', 'DashboardController@viewUsers')->name('users');

        Route::get(
            'users/status/update/{id}',
            'DashboardController@updateUserStatus'
        )->name('update_users_status');

        Route::get('profile', 'DashboardController@viewProfile')->name(
            'profile'
        );

        Route::post('profile', 'DashboardController@updateProfile')->name(
            'update_user'
        );
    });

// Cases
Route::prefix('cases')
    ->name('cases.')
    ->namespace('Backend')
    ->group(function () {
        Route::get('/new', 'CasesController@unassignedCases')->name(
            'unassigned'
        );

        Route::get(
            '/assigned/{handler?}',
            'CasesController@assignedCases'
        )->name('assigned');

        Route::get('/approved', 'CasesController@approvedCases')->name(
            'approved'
        );

        Route::get('/archived', 'CasesController@archivedCases')->name(
            'archived'
        );

        Route::get('review/{id}', 'CasesController@reviewCase')->name('review');

        Route::post('assign/{case}/{user}', 'CasesController@assignCase')->name(
            'assign'
        );

        Route::get('checklists/{case}', 'CasesController@caseChecklists')->name(
            'checklists'
        );

        Route::get('documents/{case}', 'CasesController@caseDocuments')->name(
            'documents'
        );

        Route::get(
            'document/icon/{document}',
            'CasesController@getDocumentIconText'
        )->name('documents');

        Route::post(
            'unassign/{case}/{user}',
            'CasesController@unassignCase'
        )->name('unassign');

        Route::post(
            'reassign/{case}/{old_user}/{new_user}',
            'CasesController@reassignCase'
        )->name('assign');

        Route::post(
            'update/{status}/{id}',
            'CasesController@updateCaseStatus'
        )->name('update_status');
    });

// Case Handler
Route::prefix('handlers')
    ->name('handlers.')
    ->namespace('Backend')
    ->group(function () {
        Route::get('/', 'CaseHandlersController@index')->name('index');

        Route::get('create', 'CaseHandlersController@create')->name('create');

        Route::post('create', 'CaseHandlersController@storeHandler')->name(
            'store'
        );

        Route::get(
            'status/update/{handler}',
            'CaseHandlersController@updateHandlerStatus'
        )->name('update_status');

        Route::get('view/{id}', 'CaseHandlersController@show')->name('view');
    });
