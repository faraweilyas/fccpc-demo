<?php

use Illuminate\Support\Facades\Route;

Route::prefix('applicant')
    ->name('applicant.')
    ->namespace('Backend')
    ->group(function()
    {
        Route::get(
            '/',
            'ApplicantController@show'
        )
        ->name('show');

        Route::post(
            'authenticate',
            'ApplicantController@store'
        )
        ->name('store');

        Route::get(
            'track',
            'ApplicantController@trackApplication'
        )
        ->name('track');

        Route::post(
            'track',
            'ApplicantController@authenticateTrack'
        )
        ->name('authenticate.track');

        Route::get(
            'document/download/{file?}',
            'ApplicantController@downloadDocument'
        )
        ->name('document.download');
    });
