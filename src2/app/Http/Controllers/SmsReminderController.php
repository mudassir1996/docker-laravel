<?php

namespace App\Http\Controllers;

use App\Classes\Sms;
use App\Classes\Subscriber;
use App\Models\CustomerAccount;
use App\Models\Outlet;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SmsReminderController extends Controller
{
    public function index()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $creditors = CustomerAccount::leftJoin('customers', 'customer_accounts.customer_id', 'customers.id')
            ->where('customer_accounts.outlet_id', session('outlet_id'))
            ->orderBy('customer_accounts.id', 'desc')
            ->select('customer_accounts.id', 'customer_accounts.balance', 'customer_accounts.customer_id', 'customers.customer_name', 'customers.customer_phone')
            ->get();

        $creditors = $creditors->mapToGroups(function ($item) {
            return [$item['customer_id'] => $item];
        });

        return view('pages.sms_reminder.sms_to_creditors', compact('creditors'));
    }

    public function send_sms(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->recipients != '') {
            try {
                for ($i = 0; $i < count($request->recipients); $i++) {
                    $customer = CustomerAccount::leftJoin('customers', 'customer_accounts.customer_id', 'customers.id')
                        ->where('customer_accounts.customer_id', $request->recipients[$i])
                        ->where('customer_accounts.outlet_id', session('outlet_id'))
                        ->select('customer_accounts.balance', 'customers.customer_name', 'customers.customer_phone')
                        ->first();

                    $reminder = new Sms();
                    $api = 'fastsmsalerts';
                    $phone = $customer->customer_phone;
                    $message = "Dear " . $customer->customer_name .
                        ", An amount of PKR " . abs($customer->balance) .
                        " is due on you at " . session('outlet_title') .
                        ". For more information contact here, Outlet Name: " . session('outlet_title') .
                        ". Phone Number: " . session('outlet_phone') . ".";
                    $reminder->send($phone, $message, $api);
                }
                $notification = array(
                    'message' => 'SMS Reminder sent!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            } catch (Exception $e) {
                $notification = array(
                    'message' => 'Something went wrong!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }
    }
}
