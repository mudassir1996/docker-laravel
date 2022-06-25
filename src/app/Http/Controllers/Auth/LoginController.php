<?php

namespace App\Http\Controllers\Auth;

use App\Classes\PhoneFormatter;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // $this->validateLogin($request);
        if (is_numeric($request->email)) {
            $username = PhoneFormatter::format_number($request->email);

            // dd($email);
            $formatted_phone = new Request([
                'email' => $username
            ]);

            $this->validate(
                $formatted_phone,
                [
                    'email' => ['required', 'regex:/(92)[0-9]{10}/'],
                ],
                [
                    'email.required' => "Please enter email or phone number.",
                    'email.regex' => "Please enter valid phone number (92**********).",
                ]
            );

            $request->validate(
                [
                    'password' => ['required', 'string'],
                ]
            );
        } else {
            $username = $request->email;
            $request->validate(
                [
                    'email' => ['required', 'email', 'max:255'],
                    'password' => ['required', 'string'],
                ],
                [
                    'email.required' => "Please enter email or phone number.",
                    'email.email' => "Please enter valid email address.",
                ]
            );
        }
        $user = User::where('username', $username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            $this->sendFailedLoginResponse($request);
        } else {
            if ($user->status_id != '1') {
                $error = new MessageBag();
                $error->add('status', 'You are not allowed to login. Please contact our support.');
                return back()->withErrors($error);
            } else {
                Auth::login($user);
                return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
            }
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function phone_login(Request $request)
    {
        $phone = PhoneFormatter::format_number($request->phone);

        // dd($username);
        $formatted_phone = new Request([
            'phone' => $phone
        ]);

        $this->validate(
            $formatted_phone,
            [
                'phone' => ['required', 'regex:/(92)[0-9]{10}/'],
            ],
            [
                'phone.required' => "Please enter email or phone number.",
                'phone.regex' => "Please enter valid phone number (92**********).",
            ]
        );
        $request->validate([
            'otp' => ['required', 'string', 'max:4'],
        ]);
        $user = User::where('phone', $phone)->select('id', 'phone', 'otp', 'status_id')->first();

        if (!$user) {
            $error = new MessageBag();
            $error->add('phone', 'Phone number Does not exist.');
            return back()->withErrors($error)->withInput($request->all());
        } else if ($user->otp != $request->otp) {
            $error = new MessageBag();
            $error->add('otp', 'OTP is invalid');
            return back()->withErrors($error)->withInput($request->all());
        } else if ($user->status_id != '1') {
            $error = new MessageBag();
            $error->add('status', 'You are not allowed to login. Please contact our support.');
            return back()->withErrors($error)->withInput($request->all());
        } else {
            Auth::loginUsingId($user->id);
            return redirect('outlets');
        }
    }

    // public function employeeLogin(Request $request){
    //     $this->validate($request, [
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);
    // }
}
