<?php

namespace App\Http\Controllers;

use App\Models\DataSync;
use App\Models\Employee;
use App\Models\EmployeeLogin;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('employee_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $employees = DB::table('employees')
            ->select('employees.*', 'outlets.outlet_title', 'users.username')
            ->leftJoin('outlets', 'employees.outlet_id', '=', 'outlets.id')
            ->leftJoin('users', 'employees.created_by', '=', 'users.id')
            ->where('employees.outlet_id', session('outlet_id'))
            ->latest()
            ->get();

        // dd($employees);
        return view('pages.employee.employees', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('employee_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $salary_types = DB::table('salary_types')->get();
        return view('pages.employee.add_employee', compact('salary_types'));
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
            abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }


        //validating image (filetypes:jpg,png, maxsize:2MB)
        $request->validate(
            [
                'employee_name' => 'required',
                'employee_gender' => 'required',
                'employee_feature_img' => 'mimes:jpg,png|max:2048',
                'salary_type_id' => 'required_if:have_salary,1',
                'working_hours_per_day' => 'required_if:have_salary,1',
                'joining_date' => 'required_if:have_salary,1',
                'starting_date' => 'required_if:have_salary,1',
                'salary_amount' => 'required_if:have_salary,1',
            ],
            [
                'employee_name.required' => 'Employee name is required.',
                'employee_gender.required' => 'Employee gender is required.',
                'salary_type_id.required_if' => 'Please select salary type.',
                'working_hours_per_day.required_if' => 'Please enter working hours.',
                'joining_date.required_if' => 'Please select joining date.',
                'starting_date.required_if' => 'Please select starting date.',
                'salary_amount.required_if' => 'Please enter salary amount.',
            ]
        );

        if ($request->hasFile('employee_feature_img')) {
            //getting the image name
            $image_full_name = $request->employee_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->employee_feature_img->storeAs('employees', $image_name, 'public');
        } else {
            $image_name = 'placeholder.jpg';
        }

        DB::transaction(function () use ($request, $image_name) {
            //adding data to products
            $employee = new Employee(
                [
                    'employee_name' => $request->get('employee_name'),
                    'employee_gender' => $request->get('employee_gender'),
                    'employee_description' => $request->get('employee_description'),
                    'employee_phone' => $request->get('employee_phone'),
                    'employee_dob' => $request->get('employee_dob') ?? NULL,
                    'employee_email' => $request->get('employee_email'),
                    'employee_address' => $request->get('employee_address'),
                    'employee_cnic' => $request->get('employee_cnic'),
                    'employee_status' => $request->get('employee_status'),
                    'employee_feature_img' => $image_name,
                    'outlet_id' => $request->get('outlet_id'),
                    'created_by' => $request->get('created_by'),
                ]
            );

            $employee->save();

            if ($request->have_salary) {
                $per_hour_wage = 0;

                $salary_type = DB::table('salary_types')->where('id', $request->salary_type_id)->first();

                if ($salary_type->tag == 'per_month_salary') {
                    $total_hours = $request->working_hours_per_day * 30;
                    $per_hour_wage = $request->salary_amount / $total_hours;
                } else if ($salary_type->tag == 'per_week_salary') {
                    $total_hours = $request->working_hours_per_day * 7;
                    $per_hour_wage = $request->salary_amount / $total_hours;
                } else if ($salary_type->tag == 'per_day_salary') {
                    $total_hours = $request->working_hours_per_day;
                    $per_hour_wage = $request->salary_amount / $total_hours;
                }

                $employee_salary = new EmployeeSalary(
                    [
                        'employee_id' => $employee->id,
                        'salary_type_id' => $request->salary_type_id,
                        'salary_amount' => $request->salary_amount,
                        'starting_date' => $request->starting_date,
                        'joining_date' => $request->joining_date,
                        'per_hour_wage' => $per_hour_wage,
                        'working_hours_per_day' => $request->working_hours_per_day,
                        'outlet_id' => $request->get('outlet_id'),
                    ]
                );

                $employee_salary->save();
            }
        });


        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Employee added successfully!',
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
        return redirect('outlets/employees')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('employee_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('employee_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $employee = Employee::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();

        return view('pages.employee.edit_employee', compact('employee'));
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

        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        //changing data of specific id
        $employee = Employee::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();

        //setting image to ''
        $image_name = "";

        //validating image (filetypes:jpg,png, maxsize:2MB)
        $request->validate(
            [
                'employee_name' => 'required',
                'employee_gender' => 'required',
                'employee_feature_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'employee_name.required' => 'Employee name is required.',
                'employee_gender.required' => 'Employee gender is required.',
            ]
        );

        //checking if image has selected 
        if ($request->hasFile('employee_feature_img')) {
            //deleting the previous Image
            Storage::disk('public')->delete('employees/' . $employee->employee_feature_img);

            //getting the image name
            $image_full_name = $request->employee_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->employee_feature_img->storeAs('employees', $image_name, 'public');
        } else {

            //if image has not changed then uploading same image name to data base
            $image_name = $employee->employee_feature_img;
        }

        //updating values in database
        $employee->employee_name = $request->get('employee_name');
        $employee->employee_gender = $request->get('employee_gender');
        $employee->employee_phone = $request->get('employee_phone');
        $employee->employee_dob = $request->get('employee_dob') ?? NULL;
        $employee->employee_email = $request->get('employee_email');
        $employee->employee_address = $request->get('employee_address');
        $employee->employee_status = $request->get('employee_status');
        $employee->employee_feature_img = $image_name;
        $employee->employee_cnic = $request->get('employee_cnic');
        $employee->employee_description = $request->get('employee_description');
        $employee->outlet_id = $request->get('outlet_id');
        $employee->created_by = $request->get('created_by');

        if ($employee->save()) {
            $employee_login = EmployeeLogin::where('employee_id', $employee->id)->first();

            if ($request->employee_email != null && $employee_login != null) {
                $employee_login->update(['email' => $employee->employee_email]);
            }
            //setting up success message
            $notification = array(
                'message' => 'Changes Saved!',
                'alert-type' => 'success'
            );
        } else {
            //setting up error message
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }



        //redirecting to the page with notification message
        return redirect('outlets/employees')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('employee_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $employee = Employee::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();
        if (
            $employee->employee_login
            || count($employee->categories) > 0
            || count($employee->companies) > 0
            || count($employee->customers) > 0
            || count($employee->customer_accounts) > 0
            || count($employee->expense_categories) > 0
            || count($employee->expense_transactions) > 0
            || count($employee->purchase_orders) > 0
            || count($employee->purchase_order_details) > 0
            || count($employee->products) > 0
            || count($employee->product_stocks) > 0
            || count($employee->sales_orders) > 0
            || count($employee->sales_order_details) > 0
            || count($employee->payment_types) > 0
            || count($employee->payment_methods) > 0
        ) {
            $notification = array(
                'message' => 'Employee is already in use!',
                'alert-type' => 'error'
            );
            return redirect('/outlets/employees')->with($notification);
        }

        //deleting the previous Image
        Storage::disk('public')->delete('employees/' . $employee->employee_feature_img);

        DB::transaction(function () use ($id, $employee) {
            if ($employee->delete()) {
                DataSync::create([
                    'record_id' => $id,
                    'table_name' => 'employees',
                    'action' => 'delete',
                    'outlet_id' => session('outlet_id')
                ]);
            }
        });

        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Employee Deleted!',
                'alert-type' => 'success'
            );
        } else {
            //setting up error message
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }



        //redirecting to the page with notification message
        return redirect('outlets/employees')->with($notification);
    }


    public function get_employee(Request $request)
    {
        // if (!Auth::guard('web')->check()) {
        //     abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // }
        $employee = DB::table('employees')->where('id', $request->employee_id)->select('employee_email', 'employee_phone')->first();
        return response()->json($employee);
    }
}
