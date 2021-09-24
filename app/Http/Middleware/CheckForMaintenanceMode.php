<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, \Closure $next)
    {
        if (!$this->exemptIps($request))
        {
            if ($this->app->isDownForMaintenance())
                throw new HttpException(503);
        }

        return $next($request);
    }

    /*
     * Check to see if the HTTP request is from our exempt IPs
     *
     * @return bool
     */
    private function exemptIps($request)
    {
        return in_array($request->getClientIp(), config('app.exempt_maintenance_ips', []));
    }
}
