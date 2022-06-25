<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Outlet;
use App\Models\Permissions;
use App\Models\Roles;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OutletController extends Controller
{
    public function create(Request $request)
    {
        $outlets = Outlet::where('created_by', auth()->user()->id)->get();
        $free_outlets = 0;
        foreach ($outlets as $outlet) {
            $is_premium = DB::table('subscriptions')
                ->where('outlet_id', $outlet->id)
                ->where('subscription_status', 'verified')
                ->whereDate('subscription_start_date', '<=', Carbon::today()->format('Y-m-d h:i:s'))
                ->whereDate('subscription_end_date', '>=', Carbon::today()->format('Y-m-d h:i:s'))
                ->first();
            if (!$is_premium) {
                $free_outlets++;
            }
        }
        if ($free_outlets >= 3) {
            return response(
                [
                    'message' => 'Free outlet limit exceeded!'
                ],
                401
            );
        }

        $request->validate(
            [
                'outlet_title' => 'required',
                'outlet_feature_img' => 'mimes:jpg,png|max:2048',
                'outlet_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'outlet_country' => 'required',
                'outlet_state' => 'required',
                'outlet_city' => 'required',
                'business_type_id' => 'required',
            ],
            [
                'outlet_title.required' => 'Outlet title is required',
                'outlet_phone.required' => 'Outlet phone is required',
                'outlet_country.required' => 'Please select a country',
                'outlet_state.required' => 'Please select a state',
                'outlet_city.required' => 'Please select a city',
                'business_type_id.required' => 'Please select a business type',
            ]
        );


        $outlet = new Outlet(
            [
                'outlet_title' => $request->outlet_title,
                'outlet_phone' => $request->outlet_phone,
                'outlet_address' => $request->outlet_address,
                'outlet_city' => $request->outlet_city,
                'outlet_state' => $request->outlet_state,
                'outlet_country' => $request->outlet_country,
                'outlet_feature_img' => 'placeholder.jpg',
                'outlet_opening_date' => Carbon::now(),
                'outlet_registration_date' => Carbon::now(),
                'location_point_id' => 1,
                'business_type_id' => $request->business_type_id,
                'outlet_status_id' => 1,
                'created_by' => auth()->user()->id,
            ]
        );


        if ($outlet->save()) {
            $employee = Employee::create(
                [
                    'employee_name' => UserDetail::where('user_id', Auth::user()->id)->pluck('full_name')->first(),
                    'employee_gender' => 'male',
                    'employee_email' => Auth::user()->email,
                    'employee_status' => 'active',
                    'employee_description' => 'Outlet owner',
                    'employee_feature_img' => 'placeholder.jpg',
                    'outlet_id' => $outlet->id,
                    'created_by' => Auth::user()->id,
                ]
            );
            Customer::create(
                [
                    'customer_name' => 'walk-in customer',
                    'customer_feature_img' => 'placeholder.jpg',
                    'allow_credit' => '0',
                    'outlet_id' => $outlet->id,
                    'created_by' => $employee->id,
                ]
            );

            $roles = Roles::create(
                [
                    'role_title' => 'Manager',
                    'description' => 'Have access of everything',
                    'outlet_id' => $outlet->id,
                    'created_by' => $employee->id
                ]
            );

            $permissions = Permissions::pluck('id');
            $roles->permissions()->sync($permissions);
            return response()->json([
                'success' => [
                    'message' => 'Record Added.'
                ]
            ]);
        } else {
            return response(
                [
                    'message' => 'Something went wrong!'
                ],
                401
            );
        }
    }


    public function get_countries()
    {
        $countries = DB::table('countries')->get(['id', 'country_name']);
        return response()->json(
            ['Countries' => $countries]
        );
    }
    public function get_states(Request $request)
    {
        $states = DB::table('states')->where('country_id', $request->country_id)->orderBy('state_name', 'asc')->get(['id', 'state_name']);
        return response()->json(
            ['States' => $states]
        );
    }
    public function get_cities(Request $request)
    {
        $cities = DB::table('cities')->where('state_id', $request->state_id)->orderBy('city_name', 'asc')->get(['id', 'city_name']);
        return response()->json(
            ['Cities' => $cities]
        );
    }
    public function get_business()
    {
        $business = DB::table('businesses')->get(['id', 'business_title']);
        return response()->json(
            ['Business' => $business]
        );
    }
}
