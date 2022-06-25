<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ExpenseCategory;
use App\Models\ExpenseTransaction;
use App\Models\Outlet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ExpenseTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_if(Gate::denies('expense_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('expense_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $expense_transactions = DB::table('expense_transactions')
            ->select(
                'expense_transactions.*',
                'expense_categories.title as expense_category',
                'referred_employees.employee_name as referred_user',
                'payment_methods.payment_title as payment_method',
                'outlets.outlet_title',
                'employees.employee_name',
                'payment_types.title as payment_type_title',
            )
            ->leftJoin('expense_categories', 'expense_transactions.expense_category_id', '=', 'expense_categories.id')
            ->leftJoin('employees as referred_employees', 'expense_transactions.referred_user_id', '=', 'referred_employees.id')
            ->leftJoin('payment_methods', 'expense_transactions.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'expense_transactions.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'expense_categories.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'expense_transactions.created_by', '=', 'employees.id')
            ->where('expense_transactions.outlet_id', session('outlet_id'))
            ->latest()
            ->get();



        $expense_categories = ExpenseCategory::where('outlet_id', session('outlet_id'))->latest()->pluck('title', 'id');


        return view('pages.expenses.expense_transaction.expense_transaction', compact('expense_transactions', 'expense_categories'));
    }

    public function expenseByCategory(Request $request)
    {
        // abort_if(Gate::denies('expense_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('expense_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $expense_transactions = DB::table('expense_transactions')->where('expense_transactions.expense_category_id', $request->expense_category_id)
            ->select(
                'expense_transactions.*',
                'expense_categories.title as expense_category',
                'referred_employees.employee_name as referred_user',
                'payment_methods.payment_title as payment_method',
                'outlets.outlet_title',
                'employees.employee_name',
                'payment_types.title as payment_type_title',
            )
            ->leftJoin('expense_categories', 'expense_transactions.expense_category_id', '=', 'expense_categories.id')
            ->leftJoin('employees as referred_employees', 'expense_transactions.referred_user_id', '=', 'referred_employees.id')
            ->leftJoin('payment_methods', 'expense_transactions.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'expense_transactions.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'expense_categories.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'expense_transactions.created_by', '=', 'employees.id')
            ->where('expense_transactions.outlet_id', session('outlet_id'))
            ->latest()
            ->get();

        $expense_categories = ExpenseCategory::where('outlet_id', session('outlet_id'))->latest()->pluck('title', 'id');


        return view('pages.expenses.expense_transaction.expense_transaction', compact('expense_transactions', 'expense_categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expense_categories = ExpenseCategory::where('outlet_id', session('outlet_id'))->latest()->pluck('title', 'id');
        $payment_types = DB::table('payment_types')->where('outlet_id', session('outlet_id'))->get();
        $payment_methods = DB::table('payment_methods')->where('outlet_id', session('outlet_id'))->get();
        $employees = Employee::where('outlet_id', session('outlet_id'))->latest()->pluck('employee_name', 'id');

        return view('pages.expenses.expense_transaction.add_expense_transaction', compact('expense_categories', 'payment_types', 'employees', 'payment_methods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('expense_transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $request->validate(
            [
                'title' => 'required',
                'amount' => 'required|numeric',
                'expense_category_id' => 'required',
                'referred_user_id' => 'required',
                'payment_type' => 'required',
                'payment_method_id' => 'required',
            ],
            [
                'title.required' => 'Title is required.',
                'amount.required' => 'Amount is required.',
                'expense_category_id.required' => 'Please select expense category.',
                'referred_user_id.required' => 'Please select referred user.',
                'payment_type.required' => 'Please select payment type.',
                'payment_method_id.required' => 'Please select payment method.',
            ]
        );

        // dd($request->all());


        DB::transaction(function () use ($request) {
            $expense_transaction = new ExpenseTransaction($request->all());
            $expense_transaction->save();

            $payment_type = DB::table('payment_types')->where('id', $request->payment_type)->first();
            if ($payment_type->value == 0) {
                $transaction_request = new Request([
                    'amount'  => abs($request->amount),
                    'payment_type' => $payment_type,
                    'payment_method_id'  => $request->payment_method_id,
                    'payment_date'  => Carbon::now(),
                    'system_remarks' => 'expense_transaction',
                    'description' => "Transaction added from expense transaction",
                    'order_id' => $expense_transaction->id,
                ]);

                $outlet_payment_transaction = new OutletPaymentTransactionController();
                $outlet_payment_transaction->insert($transaction_request);
            }
        });
        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Expense Transaction added successfully!',
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
        return redirect()->route('expense-transaction.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\ExpenseTransaction  $expenseTransaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // abort_if(Gate::denies('expense_transaction_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // if (!Auth::guard('web')->check()) {
        //     abort_if(Gate::denies('expense_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // }

        $expense_transaction = DB::table('expense_transactions')
            ->select(
                'expense_transactions.*',
                'expense_categories.title as expense_category',
                'referred_employees.employee_name as referred_user',
                'payment_methods.payment_title as payment_method',
                'outlets.outlet_title',
                'employees.employee_name',
                'payment_types.title as payment_type_title',
            )
            ->leftJoin('expense_categories', 'expense_transactions.expense_category_id', '=', 'expense_categories.id')
            ->leftJoin('employees as referred_employees', 'expense_transactions.referred_user_id', '=', 'referred_employees.id')
            ->leftJoin('payment_types', 'expense_transactions.payment_type', '=', 'payment_types.id')
            ->leftJoin('payment_methods', 'expense_transactions.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('outlets', 'expense_categories.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'expense_transactions.created_by', '=', 'employees.id')
            ->where('expense_transactions.outlet_id', session('outlet_id'))
            ->where('expense_transactions.id', $id)
            ->first();

        return view('pages.expenses.expense_transaction.view_expense_transaction', compact('expense_transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\ExpenseTransaction  $expenseTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense_transaction = ExpenseTransaction::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();
        $expense_categories = ExpenseCategory::where('outlet_id', session('outlet_id'))->latest()->pluck('title', 'id');
        $payment_methods = DB::table('payment_methods')->latest()->pluck('payment_title', 'id');
        $employees = Employee::where('outlet_id', session('outlet_id'))->latest()->pluck('employee_name', 'id');

        return view('pages.expenses.expense_transaction.edit_expense_transaction', compact('expense_transaction', 'expense_categories', 'payment_methods', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Model\ExpenseTransaction  $expenseTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('expense_transaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $request->validate(
            [
                'title' => 'required',
                'amount' => 'required|numeric',
                'expense_category_id' => 'required',
                'referred_user_id' => 'required',
                'payment_type' => 'required',
                'payment_method_id' => 'required',
            ],
            [
                'title.required' => 'Title is required.',
                'amount.required' => 'Amount is required.',
                'expense_category_id.required' => 'Please select expense category.',
                'referred_user_id.required' => 'Please select referred user.',
                'payment_type.required' => 'Please select payment type.',
                'payment_method_id.required' => 'Please select payment method.',
            ]
        );

        $expense_transaction = ExpenseTransaction::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();

        $expense_transaction->title = $request->title;
        $expense_transaction->amount = $request->amount;
        $expense_transaction->expense_category_id = $request->expense_category_id;
        $expense_transaction->referred_user_id = $request->referred_user_id;
        $expense_transaction->payment_type = $request->payment_type;
        $expense_transaction->payment_method_id = $request->payment_method_id;
        $expense_transaction->description = $request->description;
        $expense_transaction->outlet_id = $request->outlet_id;
        $expense_transaction->created_by = $request->created_by;

        //setting up success message
        if ($expense_transaction->save()) {
            $notification = array(
                'message' => 'Changes Saved!',
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
        return redirect()->route('expense-transaction.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\ExpenseTransaction  $expenseTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // abort_if(Gate::denies('company_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('expense_transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        //selecting the specific id row for deleting from db
        $expense_transaction = ExpenseTransaction::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();

        //setting up succes message
        if ($expense_transaction->delete()) {
            $notification = array(
                'message' => 'Expense Transaction Deleted!',
                'alert-type' => 'success'
            );
        }
        //setting up succes message
        else {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect()->route('expense-transaction.index')->with($notification);
    }
    public function print_transaction($id)
    {
        // abort_if(Gate::denies('expense_transaction_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // if (!Auth::guard('web')->check()) {
        //     abort_if(Gate::denies('expense_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // }
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $expense_transaction = DB::table('expense_transactions')
            ->select(
                'expense_transactions.*',
                'expense_categories.title as expense_category',
                'referred_employees.employee_name as referred_user',
                'payment_methods.payment_title as payment_method',
                'outlets.outlet_title',
                'employees.employee_name',
                'payment_types.title as payment_type_title',
            )
            ->leftJoin('expense_categories', 'expense_transactions.expense_category_id', '=', 'expense_categories.id')
            ->leftJoin('employees as referred_employees', 'expense_transactions.referred_user_id', '=', 'referred_employees.id')
            ->leftJoin('payment_methods', 'expense_transactions.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'expense_transactions.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'expense_categories.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'expense_transactions.created_by', '=', 'employees.id')
            ->where('expense_transactions.outlet_id', session('outlet_id'))
            ->where('expense_transactions.id', $id)
            ->first();

        return view('pages.print.print_expense_transaction', compact('expense_transaction', 'outlet'));
    }
}
