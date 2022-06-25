<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmployeeTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $premium = DB::table('subscriptions')
            ->where('outlet_id', session('outlet_id'))
            ->where('subscription_status', 'verified')
            ->whereDate('subscription_start_date', '<=', Carbon::today()->format('Y-m-d h:i:s'))
            ->whereDate('subscription_end_date', '>=', Carbon::today()->format('Y-m-d h:i:s'))
            ->first();
        abort_if(!$premium, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee_transactions = EmployeeTransaction::where('employee_transactions.outlet_id', session('outlet_id'))
            ->leftJoin('employees', 'employee_transactions.employee_id', '=', 'employees.id')
            ->leftJoin('employees as created_by', 'employee_transactions.created_by', '=', 'created_by.id')
            ->leftJoin('payment_types', 'employee_transactions.payment_type_id', 'payment_types.id')
            ->orderBy('employee_transactions.id', 'desc')
            ->select(
                'employee_transactions.*',
                'employees.employee_name',
                'created_by.employee_name as creater_name',
                'payment_types.title as payment_type',
            )
            ->get();

        return view('pages.employee.employee-transactions.employee-transaction-list', compact('employee_transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $premium = DB::table('subscriptions')
            ->where('outlet_id', session('outlet_id'))
            ->where('subscription_status', 'verified')
            ->whereDate('subscription_start_date', '<=', Carbon::today()->format('Y-m-d h:i:s'))
            ->whereDate('subscription_end_date', '>=', Carbon::today()->format('Y-m-d h:i:s'))
            ->first();
        abort_if(!$premium, Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employees = Employee::where('outlet_id', session('outlet_id'))->get();
        return view('pages.employee.employee-transactions.add-employee-transaction');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
