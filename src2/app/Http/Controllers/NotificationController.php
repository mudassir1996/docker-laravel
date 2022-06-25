<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function read(Request $request)
    {
        $notificaiton = DB::table('notification_outlet')
            ->where('notification_id', $request->notification_id)
            ->where('outlet_id', $request->outlet_id)
            ->update(['read_at' => Carbon::now()]);

        return redirect()->back();
    }
}
