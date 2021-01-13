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

        Route::get('resend-email/{email}', 'ApplicantController@resendEmail')->name(
            'resend-email'
        );

        Route::post('authenticate', 'ApplicantController@store')->name('store');

        Route::get('manage', 'ApplicantController@trackApplication')->name(
            'track'
        );

        Route::post('manage', 'ApplicantController@authenticateTrack')->name(
            'authenticate.track'
        );

        Route::get('recover-id', 'ApplicantController@recoverID')->name(
            'recover_id'
        );

        Route::get(
            'document/download/{document}/{file}',
            'ApplicantController@downloadDocument'
        )->name('document.download');

        Route::get(
            'loa/download/{document?}',
            'ApplicantController@letterOfAppointmenDownload'
        )->name('download_contact_loa');

        Route::get(
            'form-doc/download/{document}',
            'ApplicantController@downloadFormDocument'
        )->name('download_form_doc');

    });
