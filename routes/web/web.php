<?php

use Illuminate\Support\Facades\Route;

Route::name('home.')
    ->namespace('Frontend')
    ->middleware('XssSanitizer')
    ->group(function()
    {
        Route::get('/test', function()
        {
            return view('test');
        })
        ->name("test");

        Route::get('/clearlogfile', function()
        {
            $filePath   = storage_path().'/logs/laravel.log';
            $read_file  = @fopen($filePath, "r+");
            if ($read_file !== false)
            {
                ftruncate($read_file, 0);
                fclose($read_file);
                echo "<p style='color:red;'>File: <b>{$filePath}</b> has been cleared!</p>";
            } else {
                echo "<p style='color:green;'>File: <b>{$filePath}</b> hasn't been cleared!</p>";
            }
        });

        Route::get('/notification', function()
        {
            $supervisor     = App\Models\User::find(5);
            $caseHandler    = App\Models\User::find(6);
            $case           = App\Models\Cases::find(114);
            $enquiry        = App\Models\Enquiry::find(37);
            // $action         = "newcase";
            // $message        = "{$case->applicant_fullname} has submitted a new notification.";
            // $action         = "assign";
            // $message        = "A new case has been assigned to you.";
            // $action         = "defresponse";
            // $message        = "Applicant has responded to deficient documents.";
            // $action         = "request_approved";
            // $message        = "Your approval request has been approved.";
            // $action         = "request_rejected";
            // $message        = "Your approval request has been rejected.";
            // $action         = "request";
            // $message        = "{$caseHandler->getFullName()} has requested approval.";
            $action         = "newenquiry";
            $message        = "iLyas Farawe has applied for a pre-notification consultation.";

            return (new App\Notifications\CaseActionNotifier($action, $message, $enquiry->id, $enquiry))->toMail($supervisor);
            // return (new App\Notifications\NotifyHandlerForDeficientCaseSubmission($action, $message, $case))->toMail($supervisor);
        });

        Route::get(
            '/',
            'HomeController@index'
        )
        ->name('index');

        Route::get(
            'fee-calculator',
            'HomeController@feeCalcutor'
        )
        ->name('fee.calculator');

        Route::get(
            'publications',
            'HomeController@publications'
        )
        ->name('publications');

        Route::get(
            'publications/{slug}',
            'HomeController@publicationView'
        )
        ->name('publications.view');

        Route::get(
            'resources',
            'HomeController@resources'
        )
        ->name('resources');

        Route::get(
            'faqs',
            'HomeController@faqs'
        )
        ->name('faqs');

        Route::get(
            'faqs/search',
            'HomeController@faqSearch'
        )
        ->name('faqs.search');

        Route::get(
            'faqs/not-found',
            'HomeController@faqNotFound'
        )
        ->name('faqs.NotFound');

        Route::get(
            'faqs/{category}',
            'HomeController@faqCategoryView'
        )
        ->name('faqs.category');

        Route::get(
            'faqs/{category}/{slug}',
            'HomeController@faq'
        )
        ->name('faqs.faq');

        Route::post(
            'faqs/{faq}/feedback',
            'HomeController@storeFeedback'
        )
        ->name('faq.feedback');
    });
