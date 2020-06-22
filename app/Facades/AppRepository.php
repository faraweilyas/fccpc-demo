<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method void __construct(null|Illuminate\Foundation\Application $app=null)
 *
 * @see \App\Enhancers\AppRepository
 */
class AppRepository extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'apprepository';
    }
}
