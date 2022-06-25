<?php

namespace App\Models;

use DateTime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class EmployeeLogin extends Authenticatable
{

    use Notifiable, HasApiTokens;
    protected $guard = "employee";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'email', 'password', 'email', 'phone', 'verification_code', 'otp', 'outlet_id', 'created_by'
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
        $user = EmployeeLogin::where('id', auth()->user()->id)->first();
        $user->verification_code = $code;
        $user->save();
        $url = env('SMS_URL');

        $parameters = [
            "id" => env('SMS_ID'),
            "pass" => env('SMS_PASS'),
            "mask" => env('MASK'),
            "to" => auth()->user()->phone,
            // "to" => "923104387828",
            "lang" => "english",
            "msg" => "<#> Your employee account verification code is " . $code . " on MgtOs."
        ];

        $ch = curl_init();
        $timeout  =  30;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $response = curl_exec($ch);
        curl_close($ch);

        LvMessageLog::create([
            'from' => $parameters['mask'],
            'to' => $parameters['to'],
            'body' => $parameters['msg'],
            'status' => 'system-generated',
            'user_type' => 'employee',
            'created_by' => $user->employee_id
        ]);

        echo $response;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

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
        return $this->belongsToMany(Roles::class, 'employee_roles')->withTimestamps();
    }


    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');
            $filter->where('employee_logins.updated_at', '>=', $last_backup_date);
        }
    }
}
