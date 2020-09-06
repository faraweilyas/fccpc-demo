<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')
    ->get('/user', function(Request $request)
    {
        return $request->user();
    });

// Applicant
Route::prefix('applicant')
    ->namespace('Api')
    ->group(function()
    {
        Route::post(
            'create',
            'ApplicantController@store'
        );

        Route::post(
            'track',
            'ApplicantController@authenticateTracking'
        );
    });

// Application Checklist
Route::prefix('checklist')
    ->namespace('Api')
    ->group(function()
    {
        Route::get(
            'groups',
            'ApplicationController@getChecklistGroups'
        );

        Route::get(
            'all',
            'ApplicationController@getChecklists'
        );

        Route::get(
            'all/{group_id}',
            'ApplicationController@getChecklistsByGroup'
        );

    });

// Application
Route::prefix('application')
    ->namespace('Api')
    ->group(function()
    {
        Route::get(
            'case-types/all',
            'ApplicationController@getCaseTypes'
        );

        Route::get(
            'case-categories/all',
            'ApplicationController@getCaseCategories'
        );

        Route::get(
            'guest/{guest:tracking_id}',
            'ApplicationController@getGuest'
        );

        Route::get(
            '{guest:tracking_id}',
            'ApplicationController@getCaseApplication'
        );

        Route::get(
            'category/save/{guest:tracking_id}/{case_category_key}',
            'ApplicationController@saveCategory'
        );

        Route::post(
            'case-info/save/{guest:tracking_id}',
            'ApplicationController@saveCaseInfo'
        );

        Route::post(
            'contact-info/save/{guest:tracking_id}',
            'ApplicationController@saveContactInfo'
        );

        Route::post(
            'document/save/{guest:tracking_id}',
            'ApplicationController@saveChecklistDocument'
        );

        Route::post(
            'submit/{guest:tracking_id}',
            'ApplicationController@submit'
        );

        Route::get(
            'document/download/{document}',
            'ApplicationController@downloadChecklistGroupDocument'
        );
    });

// User 
Route::prefix('user')
->namespace('Api')
->group(function()
    {
        Route::get(
            'account-types',
            'UserController@getAccountTypes'
        );

        Route::get(
            'status-types',
            'UserController@getAccountStatusTypes'
        );

        Route::post(
            'login',
            'UserController@authenticate'
        );

        Route::post(
            'register',
            'UserController@register'
        );

        Route::post(
            'forgot-password',
            'UserController@forgotPassword'
        );

        Route::post(
            'reset-password',
            'UserController@resetPassword'
        );
    });

Route::prefix('user')
->namespace('Api')
->middleware(['jwt.verify'])
->group(function()
    {
        Route::get(
            '/',
            'UserController@getAuthenticatedUser'
        );

        Route::post(
            'edit',
            'UserController@editUser'
        );

        Route::get(
            'delete/{user_id}',
            'UserController@deleteUser'
        );
    });

// Case Management 
Route::prefix('case')
->namespace('Api')
->middleware(['jwt.verify'])
->group(function()
    {
        Route::get(
            '/unassigned',
            'CaseController@getUnassignedCases'
        );

        Route::get(
            '/assigned/all',
            'CaseController@getAllAssignedCases'
        );

        Route::get(
            '/assigned/{handler?}',
            'CaseController@getCaseHandlerAssignedCases'
        );

        Route::get(
            '/assign/{case}/{handler}',
            'CaseController@assignCase'
        );

        Route::get(
            '/unassign/{case}/{handler}',
            'CaseController@unassignCase'
        );
    });

Route::fallback(function(){
    return response()->json(['message' => 'Not Found.'], 404);
})->name('api.fallback.404');
