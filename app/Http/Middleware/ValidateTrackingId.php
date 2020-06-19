<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Guest;
use Illuminate\Http\Request;

class ValidateTrackingId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Guest::where('tracking_id', $request->id)->first()):
            return redirect()->route('home.index');
        else:
            return $next($request);
        endif;
    }
}
