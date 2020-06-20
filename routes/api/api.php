<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')
    ->get('/user', function(Request $request)
    {
        return $request->user();
    });

Route::prefix('application')
    ->namespace('Backend')
    ->group(function()
    {
        Route::post(
            'create/{id}',
            'ApplicationAuthController@createNewCase'
        );

        Route::post(
            'upload/{id}',
            'ApplicationAuthController@uploadNewCase'
        );
    });
