<?php

namespace App\Http\Controllers;

use App\Classes\Subscriber;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employee_salaries = EmployeeSalary::where('employee_salaries.outlet_id', session('outlet_id'))
            ->leftJoin('employees', 'employee_salaries.employee_id', '=', 'employees.id')
            ->leftJoin('salary_types', 'employee_salaries.salary_type_id', '=', 'salary_types.id')
            ->leftJoin('outlets', 'employee_salaries.outlet_id', '=', 'outlets.id')
            ->select(
                'employee_salaries.*',
                'employees.employee_name',
                'salary_types.title as salary_type_title',
                'outlets.outlet_title'
            )
            ->get();

        return view('pages.hr.employee_salary.salary_list', compact('employee_salaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employee_salary = EmployeeSalary::pluck('employee_id');
        $admin_employee = Employee::where('outlet_id', session('outlet_id'))->pluck('id')->first();
        $employees = Employee::where('outlet_id', session('outlet_id'))
            ->where('id', '!=', $admin_employee)
            ->whereNotIn('id', $employee_salary)
            ->select('id', 'employee_name')
            ->get();
        $salary_types = DB::table('salary_types')->get();


        return view('pages.hr.employee_salary.add_salary', compact('employees', 'salary_types'));
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
            'salary_type_id' => 'required',
            'working_hours_per_day' => 'required|numeric',
            'joining_date' => 'required',
            'starting_date' => 'required',
            'salary_amount' => 'required|numeric',
            // 'per_hour_wage' => 'required|numeric',
        ]);
        $salary_type = DB::table('salary_types')->where('id', $request->salary_type_id)->first();
        $per_hour_wage = 0;
        if ($salary_type->tag == 'per_month_salary') {
            $total_hours = $request->working_hours_per_day * 30;
            $per_hour_wage = $request->salary_amount / $total_hours;
        } elseif ($salary_type->tag == 'per_week_salary') {
            $total_hours = $request->working_hours_per_day * 7;
            $per_hour_wage = $request->salary_amount / $total_hours;
        } elseif ($salary_type->tag == 'per_day_salary') {
            $total_hours = $request->working_hours_per_day;
            $per_hour_wage = $request->salary_amount / $total_hours;
        }
        $employee_salary = new EmployeeSalary(
            [
                'employee_id' => $request->employee_id,
                'salary_type_id' => $request->salary_type_id,
                'salary_amount' => $request->salary_amount,
                'starting_date' => $request->starting_date,
                'joining_date' => $request->joining_date,
                'per_hour_wage' => $per_hour_wage,
                'working_hours_per_day' => $request->working_hours_per_day,
                'outlet_id' => $request->outlet_id,
                'created_by' => $request->created_by,
            ]
        );



        if ($employee_salary->save()) {
            $notification = array(
                'message' => 'Employee Salary added successfully!',
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
        return redirect('outlets/hr/employee-salary')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeSalary $employeeSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employee_salary = EmployeeSalary::where('employee_salaries.id', $id)
            ->leftJoin('employees', 'employee_salaries.employee_id', '=', 'employees.id')
            ->leftJoin('outlets', 'employee_salaries.outlet_id', '=', 'outlets.id')
            ->select('employee_salaries.*', 'employees.employee_name', 'outlets.outlet_title')
            ->first();

        $salary_types = DB::table('salary_types')->get();


        return view('pages.hr.employee_salary.edit_salary', compact('employee_salary', 'salary_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'salary_type_id' => 'required',
            'working_hours_per_day' => 'required|numeric',
            'joining_date' => 'required',
            'starting_date' => 'required',
            'salary_amount' => 'required|numeric',
            // 'per_hour_wage' => 'required|numeric',
        ]);
        $salary_type = DB::table('salary_types')->where('id', $request->salary_type_id)->first();
        $per_hour_wage = 0;
        if ($salary_type->tag == 'per_month_salary') {
            $total_hours = $request->working_hours_per_day * 30;
            $per_hour_wage = $request->salary_amount / $total_hours;
        } elseif ($salary_type->tag == 'per_week_salary') {
            $total_hours = $request->working_hours_per_day * 7;
            $per_hour_wage = $request->salary_amount / $total_hours;
        } elseif ($salary_type->tag == 'per_day_salary') {
            $total_hours = $request->working_hours_per_day;
            $per_hour_wage = $request->salary_amount / $total_hours;
        }
        $employee_salary = EmployeeSalary::find($id)->update(
            [
                'salary_type_id' => $request->salary_type_id,
                'salary_amount' => $request->salary_amount,
                'starting_date' => $request->starting_date,
                'joining_date' => $request->joining_date,
                'per_hour_wage' => $per_hour_wage,
                'working_hours_per_day' => $request->working_hours_per_day,
                'outlet_id' => $request->outlet_id,
                'created_by' => $request->created_by,
            ]
        );

        if ($employee_salary) {
            $notification = array(
                'message' => 'Employee Salary updated successfully!',
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
        return redirect('outlets/hr/employee-salary')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $query = EmployeeSalary::find($id)->delete();
        if ($query) {
            $notification = array(
                'message' => 'Employee Salary deleted successfully!',
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
        return redirect('outlets/hr/employee-salary')->with($notification);
    }

    public function get_salary_data(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employee_salary = EmployeeSalary::where('employee_id', $request->employee_id)->first();
        return $employee_salary;
        if (!$employee_salary) {
            $notification = array(
                'message' => 'Employee Salary does not exist.',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        } else {

            return response()->json($employee_salary);
        }
    }
}
