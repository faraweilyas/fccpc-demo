<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method void __construct(null|Illuminate\Foundation\Application $app=null)
 * @method string generate(callable $callable, string $preText = null, string $postText = null)
 * @method string serialNumber(string $preText = 'CHCO', string $postText = 'SN')
 * @method string trackingId()
 * @method string referenceNo()
 *
 * @see \App\Enhancers\SerialNumber
 */
class SerialNumber extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'serialnumber';
    }
}
