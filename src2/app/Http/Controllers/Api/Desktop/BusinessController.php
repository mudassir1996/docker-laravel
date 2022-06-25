<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    public function index()
    {
        $outlet_business_types = Outlet::where('created_by', auth()->user()->id)->pluck('business_type_id');
        $business = Business::whereIn('id', $outlet_business_types)->get();
        return response()->json(
            ['Business' => $business]
        );
    }
}
