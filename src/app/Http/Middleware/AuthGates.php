<?php

namespace App\Http\Middleware;

use App\Models\Business;
use App\Models\Outlet;
use App\Models\Roles;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            if (session('outlet_id')) {
                $businesses = Business::with(['screens'])->get();
                $screensArray = [];


                foreach ($businesses as $business) {
                    foreach ($business->screens as $screens) {
                        $screensArray[$screens->screen_title][] = $business->id;
                    }
                }
                // dd($screensArray);
                $outlet = Outlet::find(session('outlet_id'));
                $outlet_business = $outlet->business()->pluck('id')->toArray();
                foreach ($screensArray as $title => $business) {
                    Gate::define($title, function () use ($business, $outlet_business) {
                        return count(array_intersect($outlet_business, $business)) > 0;
                    });
                }
            }


            if (!Auth::guard('web')->check()) {
                $roles = Roles::with(['permissions'])
                    ->select('id', 'role_title')
                    ->get();

                $permissionsArray = [];
                foreach ($roles as $role) {
                    foreach ($role->permissions as $permissions) {
                        $permissionsArray[$permissions->permission_title][] = $role->id;
                    }
                }

                foreach ($permissionsArray as $title => $roles) {
                    Gate::define($title, function ($user) use ($roles) {
                        return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
                    });
                }
            }
        }

        return $next($request);
    }
}
