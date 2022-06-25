<?php

namespace App\Http\Controllers\Auth;

use App\Classes\Sms;
use App\Classes\Strings;
use App\Http\Controllers\Controller;
use App\Models\EmployeeLogin;
use App\Models\LvMessageLog;
use App\Notifications\VerifyEmailNotification;
use App\Providers\RouteServiceProvider;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\MessageBag;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    // use VerifiesEmails;

    // /**
    //  * Where to redirect users after verification.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('signed')->only('verify');
    //     $this->middleware('throttle:6,1')->only('verify', 'resend');
    // }

    public function __construct()
    {

        $this->middleware('auth:web,employee');
        $this->middleware('checkPhone');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        return view('auth.verify');
    }

    public function verify_email(Request $request)
    {
        // $request->user()->sendEmailVerificationNotification();

        if (!Auth::guard('employee')->check()) {
            $url = URL::temporarySignedRoute(
                'verification.email.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $request->user()->getKey(),
                    'hash' => sha1($request->user()->getEmailForVerification()),
                ]
            );
            $genericUrl = $url;
        } else if (Auth::guard('employee')->check()) {
            $verifyUrl = URL::temporarySignedRoute(
                'employee_verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $request->user()->getKey(),
                    'hash' => sha1($request->user()->getEmailForVerification()),
                ]
            );

            $genericUrl = $verifyUrl;
        }
        $request->user()->notify(new VerifyEmailNotification($genericUrl));

        $notification = array(
            'message' => 'Verification Code Sent!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function send_phone_code(Request $request)
    {
        // return auth()->user()->phone;
        // return $request->user()->sendPhoneVerificationNotification();
        $request->user()->sendPhoneVerificationNotification();
        $notification = array(
            'message' => 'Verification Code Sent!',
            'alert-type' => 'success'
        );
        return redirect()->route('verification.add.code')->with($notification);
    }



    public function add_phone_code()
    {
        return view('auth.email.verify-code');
    }


    public function verify_code(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric'
        ]);

        if (auth()->guard('employee')->check()) {
            $user = EmployeeLogin::where(
                'verification_code',
                $request->code
            )->first();
        } else if (!auth()->guard('employee')->check()) {
            $user = User::where(
                'verification_code',
                $request->code
            )->first();
        }


        if ($user) {
            $user->phone_verified_at = Carbon::now();
            $user->save();

            if (auth()->guard('employee')->check()) {

                $msg = Strings::welcomeMessage();
                $api = 'lifetimesms';
                $sms = new Sms();
                $sms->send($user->phone, $msg, $api);

                LvMessageLog::create([
                    'from' => env('SHORT_CODE'),
                    'to' => $user->phone,
                    'body' => $msg,
                    'status' => 'system-generated',
                    'user_type' => 'employee',
                    'created_by' => $user->employee_id
                ]);

                Auth::logout();
                return redirect('employee/login');
            } else if (!auth()->guard('employee')->check()) {

                $msg = Strings::welcomeMessage();
                $api = 'fastsmsalerts';
                $sms = new Sms();
                $sms->send($user->phone, $msg, $api);
                LvMessageLog::create([
                    'from' => env('MASK'),
                    'to' => $user->phone,
                    'body' => $msg,
                    'status' => 'system-generated',
                    'user_type' => 'user',
                    'created_by' => $user->id
                ]);

                Auth::logout();
                return redirect('outlets');
            }
        } else {
            $wrong_code = new MessageBag();
            $wrong_code->add('code', 'Your verification code is not valid.');

            return back()->withErrors($wrong_code);
        }
    }
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {

        if (!hash_equals((string) $request->route('id'), (string) $request->user()->getKey())) {
            throw new AuthorizationException();
        }

        if (!hash_equals((string) $request->route('hash'), sha1($request->user()->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {

            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect($this->redirectPath());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if ($response = $this->verified($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect($this->redirectPath())->with('verified', true);
    }

    /**
     * The user has been verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function verified(Request $request)
    {
        Auth::logout();
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return $request->wantsJson()
            ? new JsonResponse([], 202)
            : back()->with('resent', true);
    }


    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/login';
    }
}
