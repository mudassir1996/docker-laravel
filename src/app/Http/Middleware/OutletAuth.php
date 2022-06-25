<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;

class OutletAuth
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
        if (!$request->session()->has('outlet_id')) {
            $notification = array(
                'message' => 'Select an outlet first',
                'alert-type' => 'error'
            );
            return redirect('/outlets')->with($notification);
        }
        return $next($request);
    }
}
