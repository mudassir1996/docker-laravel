<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index($id)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $customers = Customer::where('outlet_id', $id)
                    ->select('id', 'customer_name')
                    ->get();
                return response()->json([
                    'Customers' => $customers->slice(1, count($customers))
                ]);
            } else {
                return response(
                    [
                        'message' => 'Sorry, you are not allowed to access this outlet.'
                    ],
                    401
                );
            }
        } else {
            return response(
                [
                    'message' => 'Sorry, you are not allowed to access this outlet.'
                ],
                401
            );
        }
    }

    public function store(Request $request, $id)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        // return $outlet;
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $employee = Employee::where('outlet_id', $outlet->id)->first();
                $customer = Customer::create(
                    [
                        'customer_name' => $request->get('customer_name'),
                        'customer_phone' => $request->get('customer_phone'),
                        'customer_feature_img' => 'placeholder.jpg',
                        'outlet_id' => $outlet->id,
                        'created_by' => $employee->id
                    ]
                );
                $customer->save();
                return response()->json([
                    'success' => [
                        'message' => 'Record Added.'
                    ]
                ]);
            } else {
                return response(
                    [
                        'message' => 'Sorry, you are not allowed to access this outlet.'
                    ],
                    401
                );
            }
        } else {
            return response(
                [
                    'message' => 'Sorry, you are not allowed to access this outlet.'
                ],
                401
            );
        }
    }
}
