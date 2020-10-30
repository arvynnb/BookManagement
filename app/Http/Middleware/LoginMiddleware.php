<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class LoginMiddleware
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
        if (!Auth::check()) {
            return redirect('/');

            if(Auth::user()->role != 1)
            {
                return redirect('/');
            }
        }
        else
        {
            if(Auth::user()->role == 1)
            {
                return $next($request);
            }
            return redirect('/');
        }
    }
}
