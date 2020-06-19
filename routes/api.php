<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function(Request $request)
{
    return $request->user();
});

Route::group(['prefix' => 'application', 'namespace' => 'Backend'], function()
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
