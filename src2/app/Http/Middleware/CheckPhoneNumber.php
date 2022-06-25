<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPhoneNumber
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
        return $next($request);
        // if (auth()->user()->phone == null) {
        //     return redirect()->route('add-phone.show');
        // } else {
        //     return $next($request);
        // }
    }
}
