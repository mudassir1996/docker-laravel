<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Cashbook\Cashbook;
use App\Models\Employee;
use App\Models\OutletPaymentTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashbookController extends Controller
{
    public function index($id)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $cashbook = Cashbook::filter()->where('outlet_id', $id)->latest()->get();
                // return $cashbook;

                $cash_in_amount = $cashbook->sum(function ($item) {
                    if ($item->transaction_type == 'cash_in') {
                        return $item->amount;
                    }
                });
                $cash_out_amount = $cashbook->sum(function ($item) {
                    if ($item->transaction_type == 'cash_out') {
                        return $item->amount;
                    }
                });
                $final_balance = $cash_in_amount - $cash_out_amount;

                return response()->json([
                    'Cashbook' => $cashbook,
                    'totalCashInAmount' => $cash_in_amount ?? 0,
                    'totalCashOutAmount' => $cash_out_amount ?? 0,
                    'finalBalance' => $final_balance ?? 0,
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
                DB::transaction(function () use ($request, $outlet) {
                    $employee = Employee::where('outlet_id', $outlet->id)->first();
                    $cashbook = new Cashbook([
                        "title" => $request->title,
                        "remarks" => $request->remarks,
                        "amount" => $request->amount,
                        "supplier_id" => $request->supplier_id ?? 0,
                        "customer_id" => $request->customer_id ?? 0,
                        "transaction_type" => $request->transaction_type == 1 ? 'cash_out' : 'cash_in',
                        "payment_category_id" => $request->payment_category_id ?? 0,
                        "payment_date" => $request->payment_date ?? Carbon::now(),
                        "payment_method_id" => $request->payment_method_id ?? 0,
                        "outlet_id" => $outlet->id,
                        "created_by" => $employee->id
                    ]);
                    $cashbook->save();

                    $balance = OutletPaymentTransaction::where('payment_method_id', $request->payment_method_id)->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
                    $balance = $balance ?? 0;

                    if ($request->transaction_type == 1) {
                        $transaction_type = 'credit';
                        $new_balance = $balance - $request->amount;
                    } else {
                        $transaction_type = 'debit';
                        $new_balance = $balance + $request->amount;
                    }


                    OutletPaymentTransaction::create([
                        'amount'  => $request->amount,
                        'balance'  =>  $new_balance,
                        'transaction_type'  => $transaction_type,
                        'system_remarks'  => 'cashbook',
                        'description'  => $request->remarks,
                        'payment_date'  => $request->payment_date,
                        'payment_method_id'  => $request->payment_method_id,
                        'order_id' => $cashbook->id,
                        'customer_id' => $request->customer_id ?? 0,
                        'supplier_id' => $request->supplier_id ?? 0,
                        "outlet_id" => $outlet->id,
                        "created_by" => $employee->id
                    ]);
                });
                if (DB::transactionLevel() == 0) {
                    return response()->json([
                        'success' => [
                            'message' => 'Record Added.'
                        ]
                    ]);
                }
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
