<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\OutletPaymentTransaction;
use App\Models\PaymentMethod;
use App\Models\PaymentType;
use App\Models\Supplier;
use App\Models\SupplierAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\MessageBag;

class OutletPaymentTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('airline_screens')) {
            $outlet_transactions = OutletPaymentTransaction::filter()->where('outlet_payment_transactions.outlet_id', session('outlet_id'))
                ->LeftJoin('parties as customers', 'customers.id', 'outlet_payment_transactions.customer_id')
                ->LeftJoin('parties as suppliers', 'suppliers.id', 'outlet_payment_transactions.supplier_id')
                // ->LeftJoin('customers', 'customers.id', 'outlet_payment_transactions.customer_id')
                ->LeftJoin('payment_methods', 'payment_methods.id', 'outlet_payment_transactions.payment_method_id')
                ->LeftJoin('employees', 'employees.id', 'outlet_payment_transactions.created_by')
                ->select('outlet_payment_transactions.*', 'suppliers.party_title as supplier_title', 'customers.party_title as customer_name', 'payment_methods.payment_title as payment_method', 'employees.employee_name')
                ->orderByDesc('outlet_payment_transactions.id')
                ->get();
        } else {
            $outlet_transactions = OutletPaymentTransaction::filter()->where('outlet_payment_transactions.outlet_id', session('outlet_id'))
                ->LeftJoin('suppliers', 'suppliers.id', 'outlet_payment_transactions.supplier_id')
                ->LeftJoin('customers', 'customers.id', 'outlet_payment_transactions.customer_id')
                ->LeftJoin('payment_methods', 'payment_methods.id', 'outlet_payment_transactions.payment_method_id')
                ->LeftJoin('employees', 'employees.id', 'outlet_payment_transactions.created_by')
                ->select('outlet_payment_transactions.*', 'suppliers.supplier_title', 'customers.customer_name', 'payment_methods.payment_title as payment_method', 'employees.employee_name')
                ->orderByDesc('outlet_payment_transactions.id')
                ->get();
        }

        return view('pages.outlet-payments.outlet-transactions', compact('outlet_transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_methods = PaymentMethod::join('payment_types', 'payment_types.id', 'payment_methods.payment_type_id')
            ->where('payment_types.value', 0)
            ->where('payment_methods.outlet_id', session('outlet_id'))
            ->select('payment_methods.id', 'payment_methods.payment_title')->get();
        $suppliers = Supplier::where('outlet_id', session('outlet_id'))->latest()->get();
        $customers = Customer::where('outlet_id', session('outlet_id'))->latest()->get();
        return view('pages.outlet-payments.add-transaction', compact('payment_methods', 'suppliers', 'customers'));
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
            $new_balance = 0;

            $balance = OutletPaymentTransaction::where('payment_method_id', $request->payment_method_id)->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
            $balance = $balance ?? 0;

            if ($request->transaction_type == 'debit') {
                $new_balance = $balance + $request->amount;
            }
            if ($request->transaction_type == 'credit') {
                $new_balance = $balance - $request->amount;
            }

            $outlet_transaction = OutletPaymentTransaction::create([
                'payment_method_id' => $request->payment_method_id,
                'amount' => $request->amount,
                'balance' => $new_balance,
                'transaction_type' => $request->transaction_type,
                'system_remarks' => 'outlet_transaction',
                'description' => $request->description,
                'payment_date' => $request->payment_date,
                'order_id' => $request->order_id ?? 0,
                'supplier_id' => $request->supplier_id,
                'customer_id' => $request->customer_id,
                'outlet_id' => session('outlet_id'),
                'created_by' => session('employee_id'),
            ]);

            if ($request->supplier_id != '') {
                $new_balance = 0;
                $supplier_balance = SupplierAccount::where('supplier_id', $request->supplier_id)->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
                $supplier_balance = $supplier_balance ?? 0;

                if ($request->transaction_type == 'debit') {
                    $payment_type_value = 1;
                    $new_balance = $supplier_balance - $request->amount;
                }
                if ($request->transaction_type == 'credit') {
                    $payment_type_value = 0;
                    $new_balance = $supplier_balance + $request->amount;
                }

                $supplier_account = SupplierAccount::create([
                    'amount' => $request->amount,
                    'balance' => $new_balance,
                    'payment_method_id' => $request->payment_method_id,
                    'payment_type' => PaymentType::where('value', $payment_type_value)->pluck('id')->first(),
                    'description' => $request->description,
                    'payment_date' => $request->payment_date,
                    'order_id' => $request->order_id ?? 0,
                    'supplier_id' => $request->supplier_id,
                    'outlet_id' => session('outlet_id'),
                    'created_by' => session('employee_id'),
                ]);
            }

            if ($request->customer_id != '') {
                $is_allow_credit = Customer::where('id', $request->customer_id)->where('outlet_id', session('outlet_id'))->pluck('allow_credit')->first();
                $new_balance = 0;
                $customer_balance = CustomerAccount::where('customer_id', $request->customer_id)->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
                $customer_balance = $customer_balance ?? 0;

                if ($request->transaction_type == 'debit') {
                    // if (!$is_allow_credit && $customer_balance > $request->amount) {
                    //     $error = new MessageBag();
                    //     $error->add('amount', 'Cutomer have not enough balance');
                    //     return back()->withInput()->withErrors($error);
                    // }
                    $payment_type_value = 1;
                    $new_balance = $customer_balance - $request->amount;
                }
                if ($request->transaction_type == 'credit') {
                    $payment_type_value = 0;
                    $new_balance = $customer_balance + $request->amount;
                }

                $customer_account = CustomerAccount::create([
                    'amount' => $request->amount,
                    'balance' => $new_balance,
                    'payment_method_id' => $request->payment_method_id,
                    'payment_type' => PaymentType::where('value', $payment_type_value)->pluck('id')->first(),
                    'description' => $request->description,
                    'payment_date' => $request->payment_date,
                    'order_id' => $request->order_id ?? 0,
                    'customer_id' => $request->customer_id,
                    'outlet_id' => session('outlet_id'),
                    'created_by' => session('employee_id'),
                ]);
            }
        });


        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Outlet transaction added successfully!',
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
        return redirect()->route('outlet-payment-transactions.index')->with($notification);
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

    public function balanceSheet()
    {
        $balance_sheet = PaymentMethod::where('payment_methods.outlet_id', session('outlet_id'))
            ->leftJoin('payment_types', 'payment_types.id', 'payment_methods.payment_type_id')
            ->leftJoin('outlet_payment_transactions', 'outlet_payment_transactions.payment_method_id', 'payment_methods.id')
            ->where('payment_types.value', 0)
            ->select('outlet_payment_transactions.payment_method_id', 'outlet_payment_transactions.balance', 'payment_methods.payment_title as payment_method')
            ->orderBy('outlet_payment_transactions.id', 'desc')
            ->get();

        $balance_sheet = $balance_sheet->mapToGroups(function ($item) {
            return [$item['payment_method'] => $item];
        });
        $balance_sheet = $balance_sheet->sortKeys();

        $payment_methods = PaymentMethod::where('payment_methods.outlet_id', session('outlet_id'))
            ->join('payment_types', 'payment_types.id', 'payment_methods.payment_type_id')
            ->where('payment_types.value', '!=', 1)
            ->select('payment_methods.id', 'payment_methods.payment_title')
            ->get();

        return view('pages.outlet-payments.balance-sheet', compact('balance_sheet', 'payment_methods'));
    }

    public function cashTransfer(Request $request)
    {
        DB::transaction(function () use ($request) {
            $transfer_from_balance = OutletPaymentTransaction::where('payment_method_id', $request->account_from)
                ->where('outlet_id', session('outlet_id'))
                ->latest()
                ->pluck('balance')
                ->first() ?? 0;

            $new_transfer_from_balance = $transfer_from_balance - $request->amount;
            OutletPaymentTransaction::create([
                'payment_method_id' => $request->account_from,
                'amount' => $request->amount,
                'balance' => $new_transfer_from_balance,
                'transaction_type' => 'credit',
                'system_remarks' => 'cash_transfer',
                'description' => $request->purpose,
                'payment_date' => Carbon::now(),
                'outlet_id' => session('outlet_id'),
                'created_by' => session('employee_id'),
            ]);

            $transfer_to_balance = OutletPaymentTransaction::where('payment_method_id', $request->account_to)
                ->where('outlet_id', session('outlet_id'))
                ->latest()
                ->pluck('balance')
                ->first() ?? 0;

            $new_transfer_to_balance = $transfer_to_balance + $request->amount;

            OutletPaymentTransaction::create([
                'payment_method_id' => $request->account_to,
                'amount' => $request->amount,
                'balance' => $new_transfer_to_balance,
                'transaction_type' => 'debit',
                'system_remarks' => 'cash_transfer',
                'description' => $request->purpose,
                'payment_date' => Carbon::now(),
                'outlet_id' => session('outlet_id'),
                'created_by' => session('employee_id'),
            ]);
        });
        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Cash transfered successfully!',
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

        return back()->with($notification);
    }


    /**
     * Add data in db.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {

        $balance = OutletPaymentTransaction::where('payment_method_id', $request->payment_method_id)->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
        $balance = $balance ?? 0;

        if (
            $request->system_remarks == 'sales_orders'
            || $request->system_remarks == 'customer_accounts'
            || $request->system_remarks == 'supplier_accounts'
        ) {
            if ($request->payment_type->value == 0) {
                $transaction_type = 'debit';
                $new_balance = $balance + $request->amount;
            }
            if ($request->payment_type->value == 1) {
                $transaction_type = 'credit';
                $new_balance = $balance - $request->amount;
            }
        } else if ($request->system_remarks == 'add_party_transaction') {
            if ($request->payment_type->value == 0) {
                $transaction_type = 'credit';
                $new_balance = $balance - $request->amount;
            }
            if ($request->payment_type->value == 1) {
                $transaction_type = 'debit';
                $new_balance = $balance + $request->amount;
            }
        } else {
            if ($request->payment_type->value == 0) {
                $transaction_type = 'credit';
                $new_balance = $balance - $request->amount;
            }
        }

        OutletPaymentTransaction::create([
            'amount'  => $request->amount,
            'balance'  =>  $new_balance,
            'transaction_type'  => $transaction_type,
            'system_remarks'  => $request->system_remarks,
            'description'  => $request->description,
            'payment_date'  => $request->payment_date,
            'payment_method_id'  => $request->payment_method_id,
            'order_id' => $request->order_id ?? 0,
            'customer_id' => $request->customer_id ?? 0,
            'supplier_id' => $request->supplier_id ?? 0,
            'outlet_id' => session('outlet_id'),
            'created_by' => session('employee_id'),
        ]);
    }
}
