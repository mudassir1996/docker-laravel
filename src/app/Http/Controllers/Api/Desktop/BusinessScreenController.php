<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Support\Facades\DB;

class BusinessScreenController extends Controller
{
    public function index()
    {
        $outlet_business_types = Outlet::where('created_by', auth()->user()->id)->pluck('business_type_id');
        $business_screens = DB::table('business_screen')->whereIn('business_id', $outlet_business_types)->get();
        return response()->json(
            ['BusinessScreens' => $business_screens]
        );
    }
}
