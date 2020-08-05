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
    });

