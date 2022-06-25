<?php

namespace App\Http\Controllers;

use App\Classes\Sms;
use App\Models\Customer;
use App\Models\Outlet;
use App\Models\SmsCampaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $smsCampaigns = SmsCampaign::where("status", "active")->where("outlet_id", session("outlet_id"))->get();
        dd($smsCampaigns);

        return view('pages.sms-marketing.campaign.index');
    }



    public function create()
    {
        $customers = Customer::where('outlet_id', session('outlet_id'))->where('customer_phone', '!=', '')->select('customer_name', 'customer_phone')->get();
        return view('pages.sms-marketing.campaign.create', compact('customers'));
    }



    public function store(Request $request)
    {
        $request->validate(
            [
                "campaign_title" => "required|string",
                "status" => "required|string",
                "schedule" => "required|string",
                "sms_text" => "required|string",
                "recepients" => "required_without:other_recepients",
                "other_recepients" => "required_without:recepients",
            ],
            [
                "campaign_title" => "Please enter campaign title",
                "status" => "Please select status",
                "schedule" => "Please set a schedule",
                "sms_text" => "Please enter sms text",
                "recepients" => "Enter atleast one recepient",
                "other_recepients" => "Enter atleast one recepient",
            ]
        );
        //convering array to comma seperated string
        $savedRecipients = implode(",", $request->recepients);

        //other recepients
        $otherRecipients = $request->other_recepients;

        //concatinating both recepients
        $recepients = $savedRecipients . "," . $otherRecipients;

        //removeing duplicate recepients
        $recepients = implode(',', array_unique(explode(',', $recepients)));

        $smsCampaign = new SmsCampaign();
        $smsCampaign->campaign_title = $request->campaign_title;
        $smsCampaign->status = $request->status;
        $smsCampaign->schedule = $request->schedule;
        $smsCampaign->sms_text = $request->sms_text;
        $smsCampaign->recepients = $recepients;
        $smsCampaign->outlet_id = session("outlet_id");
        $smsCampaign->created_by = session("employee_id");

        //setting up success message
        if ($smsCampaign->save()) {
            $notification = array(
                'message' => 'Campaign added successfully!',
                'alert-type' => 'success'
            );
        }
        //setting up error message
        else {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect()->route('campaigns.create');
    }


    public static function runCampaign($campaign)
    {
        $outlet = Outlet::where('outlets.id', $campaign->outlet_id)
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'outlets.outlet_address', 'cities.city_name')
            ->first();
        $sms_text = $campaign->sms_text;
        $sms = new Sms();
        $sms_text = str_replace("[outlet-name]", $outlet->outlet_title, $sms_text);
        $sms_text = str_replace("[outlet-phone]", $outlet->outlet_phone, $sms_text);
        $sms_text = str_replace("[outlet-address]", $outlet->outlet_address ?? $outlet->city_name, $sms_text);
        return $sms->send($campaign->recepients, $sms_text, "lifetimesms");
        // return $sms_text;
    }
}
