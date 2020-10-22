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
        if (!isset(Auth::user()->role) != 0) {
            return redirect('/');
            // return $next($request);
        }else{
            return $next($request);
        }
    }
}
