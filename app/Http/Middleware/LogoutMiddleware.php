<?php

namespace App\Http\Middleware;

use Closure;

class LogoutMiddleware
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
        return $next($request);
    }

    public function terminate($request, $response)
    {
        if (Auth::check())
        {
            if (Auth::User()->is_active != 'Y')
            {
                Auth::logout();
                return redirect('/')->with('warning', 'Logged out');
            }
        }
        return $next($request);
    }

    
}
