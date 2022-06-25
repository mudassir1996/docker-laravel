<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Outlet;
use App\Models\OutletPaymentTransaction;
use Illuminate\Http\Request;

class OutletPaymentTransactionController extends Controller
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
            $outlet_payment_transactions = OutletPaymentTransaction::datasync()->whereIn('outlet_id', $outlet)->get();

            return response()->json(
                ['OutletPaymentTransaction' => $outlet_payment_transactions]
            );
        }
    }

    public function store(Request $request)
    {

        $data = array();
        foreach ($request->all() as $field) {
            $check_payment_transactions = OutletPaymentTransaction::where('id', $field['id'])
                ->where('outlet_id', $field['outlet_id'])
                ->first();
            if ($check_payment_transactions) {
                continue;
            } else {

                $data[] = [
                    'payment_method_id' => $field['payment_method_id'],
                    'amount' => $field['amount'],
                    'balance' => $field['balance'],
                    'transaction_type' => $field['transaction_type'],
                    'system_remarks' => $field['system_remarks'],
                    'description' => $field['description'],
                    'payment_date' => $field['payment_date'],
                    'order_id' => $field['order_id'],
                    'customer_id' => $field['customer_id'],
                    'supplier_id' => $field['supplier_id'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $payment_methods = OutletPaymentTransaction::insert($data);
        $new_records = OutletPaymentTransaction::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['OutletPaymentTransaction' => $sorted->values()->all()]
        );
    }
}
