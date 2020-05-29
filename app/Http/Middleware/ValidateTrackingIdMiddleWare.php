<?php

namespace App\Http\Middleware;

use Closure;

class ValidateTrackingIdMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if (!\App\Models\Guest::where('tracking_id', $request->id)->first()):
            return redirect()->route('applicant.track');
        else:
            return $next($request);
        endif;
    }
}
