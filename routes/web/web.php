<?php

use Illuminate\Support\Facades\Route;

Route::get('/phpmyadmin', function ()
{
    return 'working';
});

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
            'publications/{publication}',
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
