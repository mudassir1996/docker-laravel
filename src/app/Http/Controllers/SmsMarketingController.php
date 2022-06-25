<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsMarketingController extends Controller
{
    public function campaign()
    {
        return view('pages.sms-marketing.campaign.index');
    }
    public function add_campaign()
    {
        return view('pages.sms-marketing.campaign.create');
    }
}
