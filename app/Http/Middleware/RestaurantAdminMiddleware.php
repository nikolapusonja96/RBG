<?php

namespace App\Http\Middleware;

use Closure;

class RestaurantAdminMiddleware
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
        if(!session()->has('restaurant'))
        {
            return redirect()->back();
        }
        return $next($request);
    }
}
