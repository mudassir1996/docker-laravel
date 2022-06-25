<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Outlet;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
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
            $payment_types = PaymentType::datasync()->whereIn('outlet_id', $outlet)->get();

            return response()->json(
                ['PaymentTypes' => $payment_types]
            );
        }
    }

    public function store(Request $request)
    {

        $data = array();
        foreach ($request->all() as $field) {
            $check_payment_types = PaymentType::where('title', $field['title'])
                ->where('id', $field['id'])
                ->where('outlet_id', $field['outlet_id'])
                ->first();
            if ($check_payment_types) {
                continue;
            } else {

                $data[] = [
                    'title' => $field['title'],
                    'description' =>  $field['description'],
                    'value' => $field['value'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $payment_types = PaymentType::insert($data);
        $new_records = PaymentType::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['PaymentTypes' => $sorted->values()->all()]
        );
    }


    public function update(Request $request)
    {
        foreach ($request->all() as $field) {

            $category = PaymentType::where('id', $field['id'])->update([
                'title' => $field['title'],
                'description' =>  $field['description'],
                'value' => $field['value'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }
}
