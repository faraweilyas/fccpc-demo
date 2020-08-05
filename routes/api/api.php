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

// Checklists
Route::prefix('checklist')
    ->namespace('Api')
    ->group(function()
    {
        Route::get(
            'groups',
            'CasesController@getChecklistGroups'
        );

        Route::get(
            'all',
            'CasesController@getChecklists'
        );
    });

//Cases
Route::prefix('cases')
    ->namespace('Api')
    ->group(function()
    {
        Route::get(
            'checklist/groups',
            'CasesController@getChecklistGroups'
        );
    });
