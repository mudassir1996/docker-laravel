<?php

namespace App\Http\Controllers;

use App\Classes\Subscriber;
use App\Models\Employee;
use App\Models\EmployeeLogin;
use App\Models\Outlet;
use App\Models\Roles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class EmployeeLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('employee_management_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('employee_login_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $employee_logins = EmployeeLogin::with(['roles'])->leftJoin('employees', 'employees.id', '=', 'employee_logins.employee_id')
            ->leftJoin('employees as e2', 'e2.id', '=', 'employee_logins.created_by')
            ->select('employees.employee_name', 'employees.created_at', 'employees.updated_at', 'employee_logins.employee_id', 'employee_logins.id', 'employee_logins.email', 'employees.outlet_id', 'employee_logins.created_by', 'e2.employee_name as creater_employee')
            ->where('employees.outlet_id', session('outlet_id'))
            ->get();

        return view('pages.employee.login.employee_login', compact('employee_logins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('employee_management_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('employee_login_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $roles = Roles::where('outlet_id', session('outlet_id'))->pluck('role_title', 'id');
        $outlets = Outlet::where('created_by', Auth::user()->id)->select('id', 'outlet_title')->get();

        $employee_logins = EmployeeLogin::pluck('employee_id');
        $admin_employee = Employee::where('outlet_id', session('outlet_id'))->pluck('id')->first();

        $employees = Employee::where('outlet_id', session('outlet_id'))
            ->where('id', '!=', $admin_employee)
            ->whereNotIn('id', $employee_logins)
            ->select('id', 'employee_name', 'employee_email')
            ->get();

        // dd($employees);

        return view('pages.employee.login.add_login', compact('employees', 'outlets', 'roles'));
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
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('employee_login_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $request->validate(
            [
                'employee_id' => 'required',
                'role_id' => 'required',
                'password' => 'required|string|min:8',
            ],
            [
                'employee_id.required' => 'Please select an employee.',
                'role_id.required' => 'Please select a role.',
            ]
        );

        $email = '';
        $phone = '';
        if (is_numeric($request->employee_username)) {

            $phone = $request->employee_username;
            $request->validate(
                [
                    'employee_username' => 'required|regex:/(923)[0-9]{9}/|max:255|unique:employee_logins,phone',
                ],
                [
                    'employee_username.regex' => "Please enter valid email/phone"
                ]
            );
        } elseif (filter_var($request->employee_username, FILTER_VALIDATE_EMAIL)) {

            $email = $request->employee_username;
        } else {
            $request->validate([
                'employee_username' => 'required|email|max:255|unique:employee_logins,email',
            ], [
                'employee_username.email' => "Please enter valid email/phone"
            ]);
        }
        $employee_login = EmployeeLogin::create([
            'employee_id' => $request->employee_id,
            'email' => $email,
            'phone' => $phone,
            'password' => Hash::make($request->password),
            'outlet_id' => session('outlet_id'),
            'created_by' => $request->created_by,
        ]);

        $employee_login->roles()->sync($request->input('role_id', []));


        $notification = array(
            'message' => 'Login Details Added',
            'alert-type' => 'success'
        );

        return redirect('outlets/employee-login')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('employee_management_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('employee_login_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('employee_management_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('employee_login_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $employee_login = EmployeeLogin::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();
        $roles = Roles::where('outlet_id', session('outlet_id'))->pluck('role_title', 'id');


        $employee_login->load('roles');
        $employees = Employee::where('outlet_id', session('outlet_id'))
            ->select('id', 'employee_name', 'employee_email')
            ->get();

        return view('pages.employee.login.edit_login', compact('employees', 'roles', 'employee_login'));
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
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('employee_login_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $request->validate(
            [
                'role_id' => 'required',
            ],
            [


                'role_id.required' => 'Please select a role.',
            ]
        );



        $employee_login = EmployeeLogin::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();

        if ($request->new_password) {
            $request->validate(
                [
                    'new_password' => 'required|string|min:8',
                ],
            );
            $employee_login->password = Hash::make($request->new_password);
        }
        $employee_login->outlet_id = session('outlet_id');
        $employee_login->created_by = $request->created_by;
        $employee_login->save();

        $employee_login->roles()->sync($request->input('role_id', []));


        $notification = array(
            'message' => 'Changes Saved!',
            'alert-type' => 'success'
        );

        //redirecting to the page with notification message
        return redirect('/outlets/employee-login')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('employee_management_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('employee_login_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $employee_login = EmployeeLogin::find($id);


        if ($employee_login->delete()) {
            $notification = array(
                'message' => 'Login Details Deleted',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        return redirect('outlets/employee-login')->with($notification);
    }
}
