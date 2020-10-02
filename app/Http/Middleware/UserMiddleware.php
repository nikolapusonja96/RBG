<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
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
        if(!session()->has('user') || (session()->has('user') && session()->get('user')->role_id != 2)) //drugi deo da admin ne moze da pridje useru
        {
            return redirect()->back()->with('message', 'Morate se prijaviti kao korisnik');
        }
        return $next($request);
    }
}
