<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class StudentMiddleware
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
        }
        else
        {
            if(Auth::user()->role == 0)
            {
                return $next($request);
            }
            return redirect('/');
        }
    }
}
