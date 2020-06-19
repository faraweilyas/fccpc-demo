<?php

namespace App\Enhancers;

/**
 * AppRepository Class
 */
class AppRepository
{
    protected $app;

    public function __construct($app=null)
    {
        $this->app = is_null($app) ? app() : $app;
    }
}
