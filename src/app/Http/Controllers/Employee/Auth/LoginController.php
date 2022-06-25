<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeLogin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/outlets';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:employee')->except('logout');
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function phone_login(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'regex:/(92)[0-9]{10}/'],
            'otp' => ['required', 'string', 'max:4'],
        ]);
        $employee = EmployeeLogin::where('phone', $request->phone)->first();

        $employee_status = Employee::where('id', $employee->employee_id)->pluck('employee_status')->first();
        if (!$employee) {
            $error = new MessageBag();
            $error->add('phone', 'Phone number Does not exist.');
            return back()->withErrors($error)->withInput($request->all());
        } else if ($employee->otp != $request->otp) {
            $error = new MessageBag();
            $error->add('otp', 'OTP is invalid');
            return back()->withErrors($error)->withInput($request->all());
        } else if ($employee_status != 'active') {
            $error = new MessageBag();
            $error->add('status', 'You are not allowed to login. Please contact our support.');
            return back()->withErrors($error)->withInput($request->all());
        } else {

            Auth::guard('employee')->loginUsingId($employee->id);
            // Auth::loginUsingId($employee->id);
            // return $employee;
            // return auth()->user()->employee_id;
            return redirect('outlets');
        }
    }



    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {

        $this->validateLogin($request);
        $employee = EmployeeLogin::where('email', $request->email)
            ->orwhere('phone', $request->email)
            ->join('employees', 'employees.id', 'employee_logins.employee_id')
            ->select('employee_logins.*', 'employees.employee_status')->first();

        if (!$employee || !Hash::check($request->password, $employee->password)) {
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        } else if ($employee->employee_status != 'active') {
            $error = new MessageBag();
            $error->add('status', 'You are not allowed to login. Please contact your outlet owner.');
            return back()->withErrors($error);
        }
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        return redirect()->route('employee.login');
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('employee');
    }


    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $username = $request->get($this->username());

        // check if the value is a validate email address and assign the field name accordingly
        $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? $this->username()  : 'phone';

        // return the credentials to be used to attempt login
        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];
    }
}
