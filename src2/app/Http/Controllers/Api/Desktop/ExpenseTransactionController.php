<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ExpenseTransaction;
use App\Models\Outlet;
use Illuminate\Http\Request;

class ExpenseTransactionController extends Controller
{
    public function index(Request $request)
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
            $expense_transactions = ExpenseTransaction::datasync()->whereIn('outlet_id', $outlet)->get();
            return response()->json(
                ['ExpenseTransactions' => $expense_transactions]
            );
        }
    }

    public function store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_transaction = ExpenseTransaction::where('outlet_id', $field['outlet_id'])
                ->where('id', $field['id'])
                ->first();
            if ($check_transaction) {
                continue;
            } else {
                $data[] = [
                    'title' =>  $field['title'],
                    'description' =>  $field['description'],
                    'amount' =>  $field['amount'],
                    'payment_type' =>  $field['payment_type'],
                    'payment_method_id' =>  $field['payment_method_id'],
                    'expense_category_id' => $field['expense_category_id'],
                    'referred_user_id' =>  $field['referred_user_id'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        // return response()->json(
        //     ['ExpenseTransactions' => $data]
        // );

        $expense_transaction = ExpenseTransaction::insert($data);
        $new_records = ExpenseTransaction::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['ExpenseTransactions' => $sorted->values()->all()]
        );
    }


    public function update(Request $request)
    {
        foreach ($request->all() as $field) {
            $expense_transaction = ExpenseTransaction::where('id', $field['id'])->update([
                'title' =>  $field['title'],
                'description' =>  $field['description'],
                'amount' =>  $field['amount'],
                'payment_type' =>  $field['payment_type'],
                'payment_method_id' =>  $field['payment_method_id'],
                'expense_category_id' => $field['expense_category_id'],
                'referred_user_id' =>  $field['referred_user_id'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }
}
