<?php

use Illuminate\Support\Facades\Route;

Route::name('home.')
    ->namespace('Frontend')
    ->group(function()
    {
        Route::get(
            '/',
            'HomeController@index'
        )
        ->name('index');

        Route::get(
            '/fee-calculator',
            'HomeController@feeCalcutor'
        )
        ->name('fee.calculator');

        Route::get(
            '/publications',
            'HomeController@publications'
        )
        ->name('publications');

        Route::get(
            '/publications/{publication}',
            'HomeController@publicationView'
        )
        ->name('publications.view');

        Route::get(
            '/faqs',
            'HomeController@faqs'
        )
        ->name('faqs');

        Route::get(
            '/faqs/{faq:slug}',
            'HomeController@faq'
        )
        ->name('faqs.faq');

        Route::post(
            '/faqs/{faq}/feedback',
            'HomeController@storeFeedback'
        )
        ->name('faq.feedback');
    });
