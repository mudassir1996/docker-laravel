<?php

namespace App\Http\Controllers\Auth;

use App\Classes\PhoneFormatter;
use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if (is_numeric($data['email'])) {
            $username = PhoneFormatter::format_number($data['email']);

            // dd($email);
            $formatted_phone = new Request([
                'email' => $username
            ]);

            $this->validate(
                $formatted_phone,
                [
                    'email' => ['required', 'regex:/(92)[0-9]{10}/', 'unique:users,phone'],
                ],
                [
                    'email.required' => "Please enter email or phone number.",
                    'email.regex' => "Please enter valid phone number (92**********).",
                    'email.unique' => "Phone number already taken."
                ]
            );



            return Validator::make(
                $data,
                [
                    'first_name' => ['required'],
                    'last_name' => ['required'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ],
                [
                    'first_name.required' => "Please enter first name.",
                    'last_name.required' => "Please enter last name.",

                ]
            );
        } else {
            return Validator::make(
                $data,
                [
                    'first_name' => ['required'],
                    'last_name' => ['required'],
                    'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ],
                [
                    'first_name.required' => "Please enter first name.",
                    'last_name.required' => "Please enter last name.",
                    'email.required' => "Please enter email or phone number.",
                    'email.email' => "Please enter valid email address.",
                    'email.unique' => "Email already taken."
                ]
            );
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data);
        $username = PhoneFormatter::format_number($data['email']);
        $user = new User([
            'password' => Hash::make($data['password']),
            'status_id' => 1,
            'verified' => 0,
            'referral_code' => $data['referral_code'],
        ]);

        if (is_numeric($data['email'])) {
            $user->username = $username;
            $user->phone = $username;
        } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $user->username = $data['email'];
            $user->email = $data['email'];
        }

        $user->save();


        UserDetail::create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'full_name' => $data['first_name'] . ' ' . $data['last_name']
        ]);

        return $user;
    }
}
