<?php

namespace App\Classes;

use App\Models\OutletSetting;

class PosSettings
{
    public static function checkSetting($setting_key)
    {
        $pos_setting = OutletSetting::where('outlet_id', session('outlet_id'))
            ->where('key', $setting_key)
            ->select('value')
            ->first();

        return $pos_setting->value == 1 ? true : false;
    }
}
