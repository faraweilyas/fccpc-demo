<?php

namespace App\Enhancers;

/**
 * AppRepository Class
 */
class AppRepository
{
    /**
     * $app App instance
     * @var null|Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Loads the app instance into scope
     *
     * @param null|Illuminate\Foundation\Application $app
     * @return void
     */
    public function __construct($app=null)
    {
        $this->app = is_null($app) ? app() : $app;
    }
}
