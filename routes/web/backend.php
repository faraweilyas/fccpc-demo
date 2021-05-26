<?php

use Illuminate\Support\Facades\Route;

Route::middleware('XssSanitizer')
    ->group(function ()
    {
        Auth::routes();
    });
