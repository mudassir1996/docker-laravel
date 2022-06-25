<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // dd(Auth::guard($guard)->check());
        if (Auth::guard($guard)->check()) {
            if ($guard == "employee") {
                //user was authenticated with admin guard.
                return redirect(RouteServiceProvider::HOME);
            } else {
                //default guard.
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
