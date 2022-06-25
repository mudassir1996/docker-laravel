<?php

namespace App\Http\Controllers;

use App\Classes\Subscriber;
use App\Models\Employee;
use App\Models\EmployeeAttendanceMetaTransaction;
use App\Models\EmployeeSalary;
use App\Models\EmployeeTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmployeeAttendanceMetaTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employee_attendance_metas = EmployeeAttendanceMetaTransaction::where('employee_attendance_meta_transactions.outlet_id', session('outlet_id'))
            ->leftJoin('employees', 'employee_attendance_meta_transactions.employee_id', '=', 'employees.id')
            ->leftJoin('employee_attendance_metas', 'employee_attendance_meta_transactions.employee_attendance_meta_id', '=', 'employee_attendance_metas.id')
            ->select(
                'employee_attendance_meta_transactions.*',
                'employees.employee_name',
                'employee_attendance_metas.title as employee_attendance_meta_title',
            )
            ->get();

        return view('pages.hr.attendance_meta_transaction.attendance-meta-transaction-list', compact('employee_attendance_metas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employees = EmployeeSalary::leftJoin('employees', 'employee_salaries.employee_id', 'employees.id')
            ->where('employees.outlet_id', session('outlet_id'))
            ->select('employees.*')
            ->get();
        $employee_attendance_metas = DB::table('employee_attendance_metas')->get();
        return view('pages.hr.attendance_meta_transaction.add-attendance-meta-transaction', compact('employee_attendance_metas', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'employee_id' => 'required',
            'employee_attendance_meta_id' => 'required',
            'date' => 'required',

        ]);
        DB::transaction(function () use ($request) {
            $employee_attendance_meta_transaction = new EmployeeAttendanceMetaTransaction(
                [
                    'employee_id' => $request->employee_id,
                    'employee_attendance_meta_id' => $request->employee_attendance_meta_id,
                    'outlet_id' => session('outlet_id'),
                    'hours' => $request->hours,
                    'per_hour_wage' => $request->per_hour_wage,
                    'amount' => $request->amount,
                    'date' => $request->date,
                ]
            );

            $employee_attendance_meta_transaction->save();

            $employee_attendance_meta = DB::table('employee_attendance_metas')->where('id', $request->employee_attendance_meta_id)->first();

            $employee_transaction = new EmployeeTransaction;
            $employee_transaction->employee_id = $employee_attendance_meta_transaction->employee_id;
            $employee_transaction->amount = $employee_attendance_meta_transaction->amount;
            $employee_transaction->status = $employee_attendance_meta->tag;
            $employee_transaction->remarks = $request->remarks;
            $employee_transaction->date = $request->date;
            $employee_transaction->outlet_id = session('outlet_id');
            $employee_transaction->created_by = session('employee_id');

            $balance = EmployeeTransaction::where('employee_id', $employee_attendance_meta_transaction->employee_id)->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
            $balance = $balance ?? 0;

            if ($employee_attendance_meta->tag == 'over_time') {

                $employee_transaction->balance = $balance + ($employee_attendance_meta_transaction->hours * $employee_attendance_meta_transaction->per_hour_wage);
                $payment_type = DB::table('payment_types')->where('value', 0)->first();
                $employee_transaction->payment_type_id = $payment_type->id;
            } else if ($employee_attendance_meta->tag == 'fine') {

                $employee_transaction->balance = $balance - ($employee_attendance_meta_transaction->hours * $employee_attendance_meta_transaction->per_hour_wage);
                $payment_type = DB::table('payment_types')->where('value', 1)->first();
                $employee_transaction->payment_type_id = $payment_type->id;
            }
            $employee_transaction->save();
        });

        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Employee Attendance Meta Transaction added successfully!',
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
        return redirect('outlets/hr/employee-attendance-meta')->with($notification);
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
        // $employee_attendance_meta_transaction = EmployeeAttendanceMetaTransaction::find($id);
        // $employees = EmployeeSalary::leftJoin('employees', 'employee_salaries.employee_id', 'employees.id')
        //     ->where('employees.outlet_id', session('outlet_id'))
        //     ->select('employees.*')
        //     ->get();
        // $employee_attendance_metas = DB::table('employee_attendance_metas')->get();
        // return view('pages.hr.attendance_meta_transaction.edit-attendance-meta-transaction', compact('employee_attendance_meta_transaction', 'employee_attendance_metas', 'employees'));
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
        // $request->validate([
        //     'employee_id' => 'required',
        //     'employee_attendance_meta_id' => 'required',

        // ]);
        // DB::transaction(function () use ($request, $id) {
        //     $employee_attendance_meta_transaction = EmployeeAttendanceMetaTransaction::where('id', $id)->where('outlet_id', session('outlet_id'))->firstOrFail();
        //     $employee_attendance_meta_transaction->employee_id = $request->employee_id;
        //     $employee_attendance_meta_transaction->employee_attendance_meta_id = $request->employee_attendance_meta_id;
        //     $employee_attendance_meta_transaction->outlet_id = session('outlet_id');
        //     $employee_attendance_meta_transaction->hours = $request->hours;
        //     $employee_attendance_meta_transaction->per_hour_wage = $request->per_hour_wage;
        //     $employee_attendance_meta_transaction->amount = $request->amount;


        //     $employee_attendance_meta_transaction->save();

        //     $employee_attendance_meta = DB::table('employee_attendance_metas')->where('id', $request->employee_attendance_meta_id)->first();

        //     $employee_transaction = new EmployeeTransaction;
        //     $employee_transaction->employee_id = $employee_attendance_meta_transaction->employee_id;
        //     $employee_transaction->outlet_id = session('outlet_id');
        //     $employee_transaction->created_by = session('employee_id');
        //     $employee_transaction->amount = $employee_attendance_meta_transaction->amount;
        //     $employee_transaction->status = $employee_attendance_meta->tag;
        //     $employee_transaction->remarks = $request->remarks;

        //     $balance = EmployeeTransaction::where('employee_id', $employee_attendance_meta_transaction->employee_id)->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
        //     $balance = $balance ?? 0;
        //     if ($employee_attendance_meta->tag == 'over_time') {

        //         $employee_transaction->balance = $balance + ($employee_attendance_meta_transaction->hours * $employee_attendance_meta_transaction->per_hour_wage);
        //         $payment_type = DB::table('payment_types')->where('value', 0)->first();
        //         $employee_transaction->payment_type_id = $payment_type->id;
        //     } else if ($employee_attendance_meta->tag == 'fine') {

        //         $employee_transaction->balance = $balance - ($employee_attendance_meta_transaction->hours * $employee_attendance_meta_transaction->per_hour_wage);
        //         $payment_type = DB::table('payment_types')->where('value', 1)->first();
        //         $employee_transaction->payment_type_id = $payment_type->id;
        //     }

        //     $employee_transaction->save();
        // });
        // //setting up success message
        // if (DB::transactionLevel() == 0) {
        //     $notification = array(
        //         'message' => 'Employee Attendance Meta Transaction updated successfully!',
        //         'alert-type' => 'success'
        //     );
        // }
        // //setting up error message
        // else {
        //     $notification = array(
        //         'message' => 'Something went wrong!',
        //         'alert-type' => 'error'
        //     );
        // }

        // //redirecting to the page with notification message
        // return redirect('outlets/hr/employee-attendance-meta')->with($notification);
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
