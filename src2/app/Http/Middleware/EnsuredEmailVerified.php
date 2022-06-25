<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsuredEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $redirectToRoute = null)
    {
        // if (Auth::guard('web')->check()) {
        //     if (
        //         !$request->user() ||
        //         ($request->user() instanceof MustVerifyEmail &&
        //             !$request->user()->hasVerifiedEmail())
        //     ) {
        //         return $request->expectsJson()
        //             ? abort(403, 'Your email address is not verified.')
        //             : Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
        //     }
        // } else if (Auth::guard('employee')->check()) {
        //     if (
        //         !$request->user() ||
        //         ($request->user() instanceof MustVerifyEmail &&
        //             !$request->user()->hasVerifiedEmail())
        //     ) {
        //         return $request->expectsJson()
        //             ? abort(403, 'Your email address is not verified.')
        //             : Redirect::route('employee_verification.notice');
        //     }
        // }

        return $next($request);
    }
}
