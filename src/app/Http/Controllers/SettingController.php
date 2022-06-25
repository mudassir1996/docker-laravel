<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\OutletSetting;
use App\Models\PaymentMethod;
use App\Models\PaymentType;
use App\Models\Subscription;
use Database\Seeders\OutletSettingSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {

        // outlet data
        $outletData = $this->getOutletData();
        $outlet = $outletData['outlet'];
        $statuses = $outletData['statuses'];
        $businesses = $outletData['businesses'];
        $countries = $outletData['countries'];

        //Outlet Settings data
        $outlet_pos_settings = OutletSetting::where('outlet_id', session('outlet_id'))->get();

        if ($outlet_pos_settings->isEmpty()) {
            $outlet_setting_seeder = new OutletSettingSeeder();
            $outlet_setting_seeder->run([
                'outlet_id' => session('outlet_id'),
                'created_by' => session('employee_id')
            ]);

            $outlet_pos_settings = OutletSetting::where('outlet_id', session('outlet_id'))->get();
        }

        // payment type data
        $payment_types = $this->paymentTypeSettings();

        //payment methods
        $payment_methods = $this->paymentMethodSettings();

        //subscription data
        $sub_detail = Subscription::join('outlets', 'subscriptions.outlet_id', 'outlets.id')
            ->join('plans', 'subscriptions.plan_id', 'plans.id')
            ->where('subscriptions.outlet_id', session('outlet_id'))
            ->select('subscriptions.*', 'outlets.outlet_title', 'plans.plan_title')
            ->orderByDesc('subscriptions.id')
            ->first();

        return view('pages.settings.index', compact('outlet', 'countries', 'businesses', 'statuses', 'payment_types', 'payment_methods', 'sub_detail', 'outlet_pos_settings'));
    }

    public function getOutletData()
    {
        $businesses = DB::table('businesses')->get();
        $statuses = DB::table('outlet_statuses')->get();
        $countries = DB::table('countries')->get();
        $outlet = Outlet::find(session('outlet_id'));

        $outletData = [
            'outlet' => $outlet,
            'countries' => $countries,
            'statuses' => $statuses,
            'businesses' => $businesses,
        ];
        return $outletData;
    }
    public function paymentTypeSettings()
    {
        $standard_payment_types = DB::table('standard_payment_types')->get();

        $payment_types = $standard_payment_types->map(function ($item) {
            $payment_type = PaymentType::where('payment_types.outlet_id', session('outlet_id'))
                ->where(
                    'title',
                    $item->title
                )
                ->first();
            if ($payment_type) {
                $item->active = 1;
            } else {
                $item->active = 0;
            }
            return $item;
        });

        return $payment_types;
    }

    public function paymentMethodSettings()
    {

        $all_payment_methods = DB::table('standard_payment_methods')
            ->leftJoin('standard_payment_types', 'standard_payment_types.id', 'standard_payment_methods.payment_type_id')
            ->where('standard_payment_types.value', '!=', 1)
            ->leftJoin('payment_methods', function ($join) {
                $join->on('standard_payment_methods.payment_title', 'payment_methods.payment_title')
                    ->where('payment_methods.outlet_id', session('outlet_id'));
            })
            ->select('standard_payment_methods.*', 'payment_methods.outlet_id')
            ->get();

        $outlet_and_std_payment_methods = $all_payment_methods->map(
            function ($item) {

                if ($item->outlet_id == session('outlet_id') || $item->outlet_id == null) {
                    return $item;
                }
            }
        );


        $payment_methods = $outlet_and_std_payment_methods->filter(
            function ($item) {
                return $item != null;
            }
        )->unique('payment_title');


        $payment_methods = $payment_methods->map(function ($item) {
            $payment_method = PaymentMethod::where('payment_methods.outlet_id', session('outlet_id'))
                ->where('payment_title', $item->payment_title)
                ->first();

            $check_std = DB::table('standard_payment_methods')
                ->where('payment_title', $item->payment_title)
                ->first();
            if ($payment_method) {
                $item->active = 1;
                $item->payment_method_id = $payment_method->id;
            } else {
                $item->active = 0;
                $item->payment_method_id = '';
            }

            if (!$check_std) {
                $item->my_method = 1;
            } else {
                $item->my_method = 0;
            }
            return $item;
        });

        return $payment_methods;
    }

    public function updatePosSetting(Request $request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->pos_settings as $key => $value) {
                OutletSetting::where('key', $key)->where('outlet_id', session('outlet_id'))
                    ->update(['value' => $value]);
            }
        });

        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Changes Saved!',
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
        return back()->with($notification);
    }
}
