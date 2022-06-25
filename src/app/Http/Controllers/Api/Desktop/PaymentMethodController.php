<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Outlet;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
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
            $payment_methods = PaymentMethod::datasync()->whereIn('outlet_id', $outlet)->get();

            return response()->json(
                ['PaymentMethods' => $payment_methods]
            );
        }
    }

    public function store(Request $request)
    {

        $data = array();
        foreach ($request->all() as $field) {
            $check_payment_methods = PaymentMethod::where('payment_title', $field['payment_title'])
                ->where('id', $field['id'])
                ->where('outlet_id', $field['outlet_id'])
                ->first();
            if ($check_payment_methods) {
                continue;
            } else {

                $data[] = [
                    'payment_title' => $field['payment_title'],
                    'payment_type_id' =>  $field['payment_type_id'],
                    'phone' => $field['phone'],
                    'address' => $field['address'],
                    'payment_description' => $field['payment_description'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $payment_methods = PaymentMethod::insert($data);
        $new_records = PaymentMethod::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['PaymentMethods' => $sorted->values()->all()]
        );
    }


    public function update(Request $request)
    {
        foreach ($request->all() as $field) {

            $payment_method = PaymentMethod::where('id', $field['id'])->update([
                'payment_title' => $field['payment_title'],
                'payment_type_id' =>  $field['payment_type_id'],
                'phone' => $field['phone'],
                'address' => $field['address'],
                'payment_description' => $field['payment_description'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }
}
