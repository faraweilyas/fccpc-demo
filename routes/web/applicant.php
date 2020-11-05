<?php

use Illuminate\Support\Facades\Route;

Route::prefix('applicant')
    ->name('applicant.')
    ->namespace('Backend')
    ->group(function () {
        Route::get('/', 'ApplicantController@show')->name('show');

        Route::get('confirm/{email}', 'ApplicantController@confirm')->name(
            'confirm'
        );

        Route::post('confirm', 'ApplicantController@confirmSubmit')->name(
            'confirm.store'
        );

        Route::post('authenticate', 'ApplicantController@store')->name('store');

        Route::get('track', 'ApplicantController@trackApplication')->name(
            'track'
        );

        Route::post('track', 'ApplicantController@authenticateTrack')->name(
            'authenticate.track'
        );

        Route::get(
            'document/download/{document}',
            'ApplicantController@downloadDocument'
        )->name('document.download');

        Route::get(
            'loa/download/{document}',
            'ApplicantController@letterOfAppointmenDownload'
        )->name('download_contact_loa');

    });
