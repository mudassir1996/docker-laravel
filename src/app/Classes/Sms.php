<?php

namespace App\Classes;

class Sms
{
    public function send($to, $msg, $api)
    {
        if ($api == 'fastsmsalerts') {
            $url = env('FAST_SMS_URL');
            $parameters = [
                "id" => env('SMS_ID'),
                "pass" => env('SMS_PASS'),
                "mask" => env('MASK'),
                "to" => $to,
                "lang" => "english",
                "msg" => $msg
            ];
        } else if ($api == 'lifetimesms') {
            $url = env('LIFETIME_SMS_URL');
            $parameters = [
                "api_token" => env('API_TOKEN'),
                "api_secret" => env('API_SECRET'),
                "from" => env('SHORT_CODE'),
                "to" => $to,
                "message" => $msg
            ];
        }




        $ch = curl_init();
        $timeout  =  30;
        curl_setopt(
            $ch,
            CURLOPT_URL,
            $url
        );
        curl_setopt(
            $ch,
            CURLOPT_RETURNTRANSFER,
            1
        );
        curl_setopt(
            $ch,
            CURLOPT_HEADER,
            0
        );
        curl_setopt(
            $ch,
            CURLOPT_SSL_VERIFYPEER,
            FALSE
        );
        curl_setopt(
            $ch,
            CURLOPT_SSL_VERIFYHOST,
            2
        );
        curl_setopt(
            $ch,
            CURLOPT_POST,
            1
        );
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            $parameters
        );
        curl_setopt(
            $ch,
            CURLOPT_TIMEOUT,
            $timeout
        );
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
