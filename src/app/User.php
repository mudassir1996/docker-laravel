<?php

namespace App;

use App\Classes\Sms;
use App\Models\EmployeeLogin;
use App\Models\LvMessageLog;
use App\Models\Roles;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'status_id',
        'phone',
        'verified',
        'referral_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userPhoneVerified()
    {
        return !is_null($this->phone_verified_at);
    }

    public function userEmailVerified()
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendPhoneVerificationNotification()
    {

        $code = mt_rand(1000, 9999);
        if (auth()->guard('employee')->check()) {
            EmployeeLogin::where('id', auth()->user()->id)->update(['verification_code' => $code]);
        } else {
            User::where('id', auth()->user()->id)->update(['verification_code' => $code]);
        }
        $msg = "<#> Your phone account code is " . $code . " on MgtOs.";
        $api = "lifetimesms";
        $sms = new Sms();
        $sms->send(auth()->user()->phone, $msg, $api);

        LvMessageLog::create([
            'from' => env('MASK'),
            'to' => auth()->user()->phone,
            'body' => $msg,
            'status' => 'system-generated',
            'user_type' => 'user',
            'created_by' => auth()->user()->id
        ]);

        // echo $response;
    }



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany(Roles::class);
    }
}
