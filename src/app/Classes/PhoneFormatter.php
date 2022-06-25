<?php

namespace App\Classes;

class PhoneFormatter
{

    static public function format_number($phone_number)
    {
        if (strlen($phone_number) > 10) {
            if (strlen($phone_number) != 12 && substr($phone_number, 0, 2) != '92') {
                if (strlen($phone_number) == 11 && substr($phone_number, 0, 2) == '03') {
                    $phone_number = substr_replace($phone_number, '923', 0, 2);
                }
                if (strlen($phone_number) == 13 && substr($phone_number, 0, 3) == '+92') {
                    $phone_number = substr_replace($phone_number, '', 0, 1);
                }
            }
            return $phone_number;
        }
    }
}
