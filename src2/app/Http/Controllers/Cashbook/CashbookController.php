<?php

namespace App\Http\Controllers\Cashbook;

use App\Http\Controllers\Controller;
use App\Models\Cashbook\Cashbook;
use App\Models\Cashbook\PaymentCategory;
use App\Models\Customer;
use App\Models\OutletPaymentTransaction;
use App\Models\PaymentMethod;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashbook = Cashbook::filter()->where('outlet_id', session('outlet_id'))->latest()->get();

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

        $payment_categories = PaymentCategory::where('outlet_id', session('outlet_id'))
            ->get();
        $payment_methods = PaymentMethod::where('payment_methods.outlet_id', session('outlet_id'))
            ->leftJoin('payment_types', 'payment_types.id', 'payment_methods.payment_type_id')
            ->where('payment_types.value', 0)
            ->select('payment_methods.id', 'payment_methods.payment_title')
            ->get();
        $suppliers = Supplier::where('outlet_id', session('outlet_id'))
            ->get();
        $customers = Customer::where('outlet_id', session('outlet_id'))
            ->latest()
            ->get();
        // dd($cashbook_transactions);
        return view('pages.cashbook.index', compact('cashbook', 'cash_in_amount', 'cash_out_amount', 'final_balance', 'payment_categories', 'suppliers', 'customers', 'payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $cashbook = new Cashbook([
                "title" => $request->title,
                "remarks" => $request->remarks,
                "amount" => $request->amount,
                "supplier_id" => $request->supplier_id ?? 0,
                "customer_id" => $request->customer_id ?? 0,
                "transaction_type" => $request->transaction_type == 1 ? 'cash_out' : 'cash_in',
                "payment_category_id" => $request->payment_category_id ?? 0,
                "payment_date" => $request->payment_date,
                "payment_method_id" => $request->payment_method_id ?? 0,
                "outlet_id" => session('outlet_id'),
                "created_by" => session('employee_id')
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
                'outlet_id' => session('outlet_id'),
                'created_by' => session('employee_id'),
            ]);
        });

        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Transaction added successfully!',
                'alert-type' => 'success'
            );
        }
        //setting up error message
        else {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect('/outlets/cashbook')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
