<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if(!session()->has('user') || (session()->has('user') && session()->get('user')->role_id != 1))
        {
            return redirect()->back();
        }
        return $next($request);
    }
}
