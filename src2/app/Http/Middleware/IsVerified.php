<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsVerified
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
        if (!auth()->guard('employee')->check()) {
            if (is_numeric(auth()->user()->username)) {
                if ($request->user()->userPhoneVerified()) {
                    return $next($request);
                } else {
                    return redirect()->route('verification.show');
                }
            } elseif (filter_var(auth()->user()->username, FILTER_VALIDATE_EMAIL)) {
                if ($request->user()->userEmailVerified()) {
                    return $next($request);
                } else {
                    return redirect()->route('verification.show');
                }
            }
        } else {
            if ($request->user()->userPhoneVerified() || $request->user()->userEmailVerified()) {
                return $next($request);
            }
            return redirect()->route('employee_verification.notice');
        }
    }
}
