<?php

namespace App\Http\Controllers;

use App\Classes\Sms;
use App\Classes\Strings;
use App\Models\EmployeeLogin;
use App\Models\LvMessageLog;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class AddPhoneController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth:web,employee');
    }
    public function show()
    {
        return view('auth.add_phone');
    }
    public function send_code(Request $request)
    {
        // return $request->phone;
        $request->validate([
            'phone' => ['required', 'string', 'regex:/(92)[0-9]{10}/'],

        ]);

        if (auth()->guard('employee')->check()) {
            $user = EmployeeLogin::find(auth()->user()->id);
        } else {
            $user = User::find(auth()->user()->id);
            // return $user->phone;
        }
        if (!$user) {
            return response(500);
        } else {
            $code = mt_rand(1000, 9999);
            $user->verification_code = $code;

            $msg = "<#> Your phone verification code is " . $code . " on MgtOs.";
            $api = 'lifetimesms';
            $sms = new Sms();
            $response = $sms->send($request->phone, $msg, $api);

            // $user->verification_code = $code;


            // $response = simplexml_load_string($response);
            if (strpos($response, 'OK') !== false) {
                $user->save();
                if (url()->previous() == route('employee.login')) {
                    LvMessageLog::create([
                        'from' => env('SHORT_CODE'),
                        'to' => $request->phone,
                        'body' => $msg,
                        'status' => 'system-generated',
                        'user_type' => 'employee',
                        'created_by' => $user->employee_id
                    ]);
                } else {
                    LvMessageLog::create([
                        'from' => env('SHORT_CODE'),
                        'to' => $request->phone,
                        'body' => $msg,
                        'status' => 'system-generated',
                        'user_type' => 'user',
                        'created_by' => $user->id
                    ]);
                }
            }
            return $response;
        }
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'phone' => ['required', 'string', 'regex:/(92)[0-9]{10}/'],
            'code' => ['required', 'max:4']
        ]);

        if (auth()->guard('employee')->check()) {
            $user = EmployeeLogin::find(auth()->user()->id);
        } else {
            $user = User::find(auth()->user()->id);
            // return $user->phone;
        }
        if ($user->verification_code == $request->code) {
            $user->phone = $request->phone;
            $user->phone_verified_at = Carbon::now();


            if ($user->save()) {
                $msg = Strings::welcomeMessage();;
                $api = 'fastsmsalerts';
                $sms = new Sms();
                $response = $sms->send($user->phone, $msg, $api);
                $response = simplexml_load_string($response);
                if ($response->type == "Success") {
                    $user->save();
                    if (url()->previous() == route('employee.login')) {
                        LvMessageLog::create([
                            'from' => env('MASK'),
                            'to' => $user->phone,
                            'body' => $msg,
                            'status' => 'system-generated',
                            'user_type' => 'employee',
                            'created_by' => $user->employee_id
                        ]);
                    } else {
                        LvMessageLog::create([
                            'from' => env('MASK'),
                            'to' => $user->phone,
                            'body' => $msg,
                            'status' => 'system-generated',
                            'user_type' => 'user',
                            'created_by' => $user->id
                        ]);
                    }
                }
            }

            return redirect('outlets');
        } else {
            $error = new MessageBag();
            $error->add('code', 'Verification code is invalid');
            return back()->withErrors($error)->withInput($request->all());
        }
    }
}
