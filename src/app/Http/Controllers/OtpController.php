<?php

namespace App\Http\Controllers;

use App\Classes\PhoneFormatter;
use App\Classes\Sms;
use App\Models\EmployeeLogin;
use App\Models\LvMessageLog;
use App\User;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function send_otp(Request $request)
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

        if (url()->previous() == route('employee.login')) {
            $user = EmployeeLogin::where('phone', $phone)->first();
        } else {
            $user = User::where('phone', $phone)->first();
        }

        // return $user->phone;
        if (!$user) {
            return response(404);
        } else {
            $otp = mt_rand(1000, 9999);
            $user->otp = $otp;
            $user->save();
            $msg = "<#> Your account login otp is " . $otp . " on MgtOs.";
            $api = 'lifetimesms';
            $sms = new Sms();
            $response = $sms->send($user->phone, $msg, $api);
            // strpos($custom_field->data_type, 'date') !== false ? 'readonly' : ''
            // $response = simplexml_load_string($response);
            if (strpos($response, 'OK') !== false) {
                if (url()->previous() == route('employee.login')) {
                    LvMessageLog::create([
                        'from' => env('SHORT_CODE'),
                        'to' => $user->phone,
                        'body' => $msg,
                        'status' => 'system-generated',
                        'user_type' => 'employee',
                        'created_by' => $user->employee_id
                    ]);
                } else {
                    LvMessageLog::create([
                        'from' => env('SHORT_CODE'),
                        'to' => $user->phone,
                        'body' => $msg,
                        'status' => 'system-generated',
                        'user_type' => 'user',
                        'created_by' => $user->id
                    ]);
                }
            }
            return $response;
        }

        // return response(200);
    }
}
