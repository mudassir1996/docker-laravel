<?php

namespace App\Http\Controllers\Api;

use App\Classes\Sms;
use App\Http\Controllers\Controller;
use App\Models\EmployeeLogin;
use App\Models\UserDetail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'phone' => 'required|regex:/(92)[0-9]{10}/|unique:users,phone',
        //     'password' => 'required|string|min:8'
        // ], [
        //     'first_name.required' => 'Please enter first name',
        //     'last_name.required' => 'Please enter last name',
        //     'phone.required' => 'Please enter phone number',
        //     'phone.unique' => 'Phone number is already taken',
        //     'phone.regex' => 'Invalid phone number',
        //     'password.required' => 'Please enter password',

        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => $validator->messages()
        //     ];
        //     return response()->json($response, 200);
        // }
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|regex:/(92)[0-9]{10}/|unique:users,phone',
            'password' => 'required|string|min:8'
        ]);

        $user = new User([
            'username' => $request->phone,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'status_id' => 1,
            'verified' => 0,
        ]);

        if ($user->save()) {
            UserDetail::create([
                'user_id' => $user->id,
                'first_name' =>  $request->first_name,
                'last_name' =>  $request->last_name,
                'full_name' =>  $request->first_name . ' ' . $request->last_name
            ]);

            $code = mt_rand(1000, 9999);
            $user->verification_code = $code;
            $user->save();
            $msg = "<#> Your phone account code is " . $code . " on MgtOs.";
            $sms = new Sms();
            $api = 'lifetimesms';
            $response = $sms->send($user->phone, $msg, $api);


            $token =  $user->createToken('myapptoken')->plainTextToken;

            $user_data = User::join('user_details', 'users.id', 'user_details.user_id')
                ->leftJoin('customer_statuses', 'users.status_id', 'customer_statuses.id')
                ->where('users.id', $user->id)
                ->select('users.*', 'user_details.first_name', 'user_details.last_name', 'customer_statuses.status_title as status', 'user_details.cnic')
                ->first();

            $response = [
                'user' => $user_data,
                'token' => $token
            ];
            return response($response, 201);
        } else {
            return response([
                'message' => 'Something went wrong!'
            ], 401);
        }
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::join('user_details', 'users.id', 'user_details.user_id')
            ->leftJoin('customer_statuses', 'users.status_id', 'customer_statuses.id')
            ->where('users.username', $fields['username'])
            ->select('users.*', 'user_details.first_name', 'user_details.last_name', 'customer_statuses.status_title as status', 'user_details.cnic')
            ->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad Creds'
            ], 401);
        }


        $token =  $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,

        ];

        return response()->json($response, 201);
    }
    public function desktop_login(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::join('user_details', 'users.id', 'user_details.user_id')
            ->select(
                'users.*',
                'user_details.id as user_details_id',
                'user_details.user_id',
                'user_details.first_name',
                'user_details.last_name',
                'user_details.full_name',
                'user_details.phone',
                'user_details.cnic',
                'user_details.address',
                'user_details.country_id',
                'user_details.state_id',
                'user_details.city_id',
                'user_details.profile_img'
            )
            ->where('username', $fields['username'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad Creds'
            ], 401);
        }
        $user->tokens()->delete();
        $token =  $user->createToken('desktop-api')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,

        ];

        return response()->json($response, 201);
    }

    public function employee_login(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);
        // return $fields['username'];

        $employee = EmployeeLogin::where('email', $fields['username'])
            ->orwhere('phone', $fields['username'])
            ->first();

        if (!$employee || !Hash::check($fields['password'], $employee->password)) {
            return response([
                'message' => 'Bad Creds'
            ], 401);
        }
        $employee->tokens()->delete();
        $token =  $employee->createToken('desktop-employee-api')->plainTextToken;

        $response = [
            'employee' => $employee,
            'token' => $token,
        ];

        return response()->json($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out'
        ];
    }

    public function currentUser()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return $user;
    }


    public function get_otp(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if (!$user) {
            return response([
                'message' => 'Invalid phone number'
            ], 401);
        }
        $otp = mt_rand(1000, 9999);
        $user->otp = $otp;
        $user->save();
        $msg = "<#> Your account login otp is " . $otp . " on MgtOs.";
        $sms = new Sms();
        $api = 'lifetimesms';
        $response = $sms->send($user->phone, $msg, $api);

        return response([
            'message' => $response
        ], 200);
    }

    public function otp_login(Request $request)
    {
        // $user = User::where('otp', $request->otp)->where('phone', $request->phone)->first();
        $user = User::join('user_details', 'users.id', 'user_details.user_id')
            ->leftJoin('customer_statuses', 'users.status_id', 'customer_statuses.id')
            ->where('users.otp', $request->otp)
            ->where('users.phone', $request->phone)
            ->select('users.*', 'user_details.first_name', 'user_details.last_name', 'customer_statuses.status_title as status', 'user_details.phone', 'user_details.cnic')
            ->first();



        if (!$user) {
            return response([
                'message' => 'Invalid otp'
            ], 401);
        }
        $user->otp = null;
        $user->save();
        $token =  $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,

        ];

        return response($response, 201);
    }
    public function phone_verify(Request $request)
    {
        // return "hello";
        // $user = User::where('otp', $request->otp)->where('phone', $request->phone)->first();
        $user = User::where('phone', auth()->user()->phone)
            ->where('verification_code', $request->verification_code)
            ->first();



        if (!$user) {
            return response([
                'message' => 'Invalid code'
            ], 401);
        } else {
            $user->verification_code = null;
            $user->phone_verified_at =  Carbon::now();
            $user->save();

            $msg = "Welcome to MgtOs, visit our website www.mgtos.com";
            $api = 'fastsmsalerts';
            $sms = new Sms();
            $response = $sms->send($user->phone, $msg, $api);

            return response(
                [
                    'message' => 'Verified'
                ],
                200
            );
        }
    }
    public function verification_resend()
    {
        $user = User::where('phone', auth()->user()->phone)->first();
        if (!$user) {
            return response([
                'message' => 'Invalid phone number'
            ], 401);
        }
        $verification_code = mt_rand(1000, 9999);
        $user->verification_code = $verification_code;
        $user->save();
        $msg = "<#> Your phone account code is " . $verification_code . " on MgtOs.";
        $sms = new Sms();
        $api = 'lifetimesms';
        $response = $sms->send($user->phone, $msg, $api);

        return response([
            'message' => $response
        ], 200);
    }
}
