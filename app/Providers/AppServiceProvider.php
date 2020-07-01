<?php

namespace App\Providers;

use App\Enhancers\AppHelper;
use App\Enhancers\SerialNumber;
use App\Enhancers\AppRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(255);

        forceHTTPSScheme();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSerialNumber();

        $this->registerAppHelper();

        $this->registerAppRepository();
    }

    public function registerSerialNumber()
    {
        app()->singleton('serialnumber', function($app)
        {
            return new SerialNumber($app);
        });
    }

    public function registerAppHelper()
    {
        app()->singleton('apphelper', function($app)
        {
            return new AppHelper($app);
        });
    }

    public function registerAppRepository()
    {
        app()->singleton('apprepository', function($app)
        {
            return new AppRepository($app);
        });
    }
}
