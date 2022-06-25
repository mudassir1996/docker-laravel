<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function index()
    {
        $sub_detail = Subscription::join('outlets', 'subscriptions.outlet_id', 'outlets.id')
            ->join('plans', 'subscriptions.plan_id', 'plans.id')
            ->where('subscriptions.outlet_id', session('outlet_id'))
            ->select('subscriptions.*', 'outlets.outlet_title', 'plans.plan_title')
            ->first();
        return view('pages.subscription.subscription-detail', compact('sub_detail'));
    }
    public function create(Request $request)
    {
        // return $request->total_bill;
        $request->validate([
            'payment_method' => 'required',
            'plan_id' => 'required',
        ], [
            'payment_method.required' => 'Please select payment method',
            'plan_id.required' => 'Please select a plan.'
        ]);
        $plan = DB::table('plans')->where('id', $request->plan_id)->select('subscription_duration')->first();
        // $previous_subscription = DB::table('subscriptions')
        //     ->where('outlet_id', session('outlet_id'))
        //     ->where('subscription_status', 'verified')
        //     ->whereDate('subscription_start_date', '<=', Carbon::today()->format('Y-m-d h:i:s'))
        //     ->whereDate('subscription_end_date', '>=', Carbon::today()->format('Y-m-d h:i:s'))
        //     ->latest()
        //     ->first();

        // return $previous_subscription;

        $start_date = Carbon::now()->format('Y-m-d H:i:s');
        $end_date = Carbon::now()->addDays($plan->subscription_duration)->format('Y-m-d H:i:s');

        $subscription = new Subscription;

        $subscription->outlet_id = session('outlet_id');
        $subscription->plan_id = $request->plan_id;
        $subscription->payment_method = $request->payment_method;
        $subscription->total_bill = $request->total_bill;
        $subscription->discount_amount = $request->discount_amount ?? '0.00';
        $subscription->paid_bill = $request->paid_bill;
        $subscription->promo_code = $request->promo_code;
        $subscription->subscription_start_date = $start_date;
        $subscription->subscription_end_date = $end_date;
        // $subscription->subscription_status = $request->subscription_status;
        $subscription->subscription_status = 'unverified';
        $subscription->creater_user_type = 'customer';
        $subscription->created_by = session('employee_id');
        $subscription->remarks = "Subscription added by customer";
        $subscription->save();
        return $subscription;
    }
}
