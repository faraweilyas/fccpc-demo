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

        Route::post(
            'case-info/save/{guest:tracking_id}',
            'ApplicationController@saveCaseInfo'
        );
    });
