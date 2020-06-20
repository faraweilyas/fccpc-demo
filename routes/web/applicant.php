<?php

use Illuminate\Support\Facades\Route;

Route::prefix('applicant')
    ->name('applicant.')
    ->namespace('Backend')
    ->group(function()
    {
        Route::post(
            'authenticate',
            'ApplicantController@authenticate'
        )
        ->name('authenticate');

        Route::get(
            'submit',
            'ApplicantController@submitApplication'
        )
        ->name('submit');

        Route::get(
            'track',
            'ApplicantController@trackApplication'
        )
        ->name('track');

        Route::post(
            'track',
            'ApplicantController@authenticateTrack'
        )
        ->name('authenticate_track');
    });
