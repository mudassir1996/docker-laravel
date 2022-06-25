<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutletController extends Controller
{
    public function index()
    {
        if (auth()->user()->employee_id) {
            $outlets = Employee::where('employees.id', auth()->user()->employee_id)
                ->join('outlets', 'outlets.id', 'employees.outlet_id')
                ->select('outlets.id')
                ->get();
        } else {

            $outlets = Outlet::where('created_by', auth()->user()->id)->get();
        }
        $outlets = $outlets->map(function ($item) {
            $image = $item->outlet_feature_img;
            if ($image != 'placeholder.jpg' && !filter_var($image, FILTER_VALIDATE_URL)) {
                $item->outlet_feature_img = asset('storage/outlets/' . $image);
            }

            return $item;
        });
        return response()->json(
            ['Outlets' => $outlets]
        );
    }
    public function outlet_status()
    {
        // $outlet_status = Outlet::where('created_by', auth()->user()->id)->pluck('outlet_status_id');
        $outlet_status = DB::table('outlet_statuses')->get();
        return response()->json(
            ['OutletStatus' => $outlet_status]
        );
    }
}
