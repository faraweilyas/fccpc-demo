<?php

namespace App\Enhancers;

/**
 * SerialNumber Class
 */
class SerialNumber
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

    /**
     * Generate serial number with length 13
     *
     * @param callable $callable
     * @param string $preText
     * @param string $postText
     * @return string
     */
    public function generate(callable $callable, string $preText = null, string $postText = null) : string
    {
        return strtoupper($preText.$callable(uniqid()).$postText);
    }

    /**
     * Generate serial number
     *
     * @param string $preText
     * @param string $postText
     * @return string
     */
    public function serialNumber(string $preText = 'CHCO', string $postText = 'SN') : string
    {
        return $this->generate(function($serialNumber)
        {
            return substr($serialNumber, 7, 13);
        }, $preText, $postText);
    }

    /**
     * Generate tracking id
     *
     * @return string
     */
    public function trackingId() : string
    {
        $monthDay = date('md');
        return $this->generate(function($serialNumber)
        {
            return substr($serialNumber, 7, 13);
        }, "APP{$monthDay}");
    }

    /**
     * Generate reference number
     *
     * @return string
     */
    public function referenceNumber() : string
    {
        $monthDay = date('md');
        return $this->generate(function($serialNumber)
        {
            return substr($serialNumber, 7, 13);
        }, "FCCPC|M&A|{$monthDay}|");
    }
}
