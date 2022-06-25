<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeLogin;
use App\Models\Outlet;
use Illuminate\Http\Request;

class EmployeeLoginController extends Controller
{
    public function index()
    {
        if (auth()->user()->employee_id) {
            $outlet = Employee::where('employees.id', auth()->user()->employee_id)
                ->join('outlets', 'outlets.id', 'employees.outlet_id')
                ->select('outlets.id')
                ->first();
        } else {

            $outlet = Outlet::where('created_by', auth()->user()->id)->pluck('id');
        }
        if ($outlet) {
            $employee_logins = EmployeeLogin::datasync()->whereIn('outlet_id', $outlet)->get();
            return response()->json(
                ['EmployeeLogin' => $employee_logins]
            );
        }
    }
}
