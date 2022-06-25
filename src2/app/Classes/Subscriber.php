<?php

namespace App\Classes;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Subscriber
{

    static public function isPremium(): bool
    {
        $premium = DB::table('subscriptions')
            ->where('outlet_id', session('outlet_id'))
            ->where('subscription_status', 'verified')
            ->whereDate('subscription_start_date', '<=', Carbon::today()->format('Y-m-d h:i:s'))
            ->whereDate('subscription_end_date', '>=', Carbon::today()->format('Y-m-d h:i:s'))
            ->first();

        return $premium ? true : false;
    }

    static public function hasPending(): bool
    {
        $pending = DB::table('subscriptions')
            ->where('outlet_id', session('outlet_id'))
            ->where('subscription_status', 'unverified')
            ->whereDate('subscription_start_date', '<=', Carbon::today()->format('Y-m-d h:i:s'))
            ->whereDate('subscription_end_date', '>=', Carbon::today()->format('Y-m-d h:i:s'))
            ->first();

        return $pending ? true : false;
    }
}
