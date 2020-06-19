<?php

namespace App\Providers;

use App\Enhancers\AppHelper;
use App\Enhancers\AppRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton(AppHelper::class, function($app)
        {
            return new AppHelper($app);
        });

        app()->singleton(AppRepository::class, function($app)
        {
            return new AppRepository($app);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        forceHTTPSScheme();
    }
}
