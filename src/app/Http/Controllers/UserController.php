<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function get_payment_method(Request $request)
    {
        $payment_methods = DB::table('payment_methods')->where('payment_type_id', $request->payment_type_id)->pluck('id', 'payment_title');
        return response()->json($payment_methods);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('user_profile_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $user_detail = Employee::where('employees.id', $id)->leftJoin('employee_logins', 'employees.id', 'employee_logins.employee_id')
                ->select('employees.id', 'employees.employee_name', 'employees.employee_phone', 'employees.employee_address', 'employees.employee_feature_img', 'employee_logins.email')->first();
            return view('pages.user.emp_profile', compact('user_detail'));
        } else {
            $countries = DB::table('countries')->get();
            $user_detail = UserDetail::where('user_id', Auth::user()->id)->first();
            return view('pages.user.profile', compact('countries', 'user_detail'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        //changing data of specific id
        $user_detail = UserDetail::where('user_id', Auth::user()->id)->first();
        // dd($user_detail);
        //setting image to ''
        $image_name = "";


        //checking if image has selected 
        if ($request->hasFile('profile_img')) {

            //validating image (filetypes:jpg,png, maxsize:2MB)
            $request->validate([
                'profile_img' => 'mimes:jpg,png|max:2048'
            ]);

            //deleting the previous Image
            Storage::disk('public')->delete('users/' . $user_detail->profile_img);

            //getting the image name
            $image_full_name = $request->profile_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->profile_img->storeAs('users', $image_name, 'public');
        } else {

            //if image has not changed then uploading same image name to data base
            $image_name = $user_detail->profile_img;
        }

        //updating values in database
        $user_detail->first_name = $request->get('first_name');
        $user_detail->last_name = $request->get('last_name');
        $user_detail->full_name = $request->get('first_name') . ' ' . $request->get('last_name');
        $user_detail->phone = $request->get('phone');
        $user_detail->cnic = $request->get('cnic');
        $user_detail->address = $request->get('address');
        $user_detail->country_id = $request->get('country_id');
        $user_detail->state_id = $request->get('state_id');
        $user_detail->city_id = $request->get('city_id');
        $user_detail->profile_img = $image_name;

        if ($user_detail->save()) {
            //setting up success message
            $notification = array(
                'message' => 'Changes Saved!',
                'alert-type' => 'success'
            );
        } else {
            //setting up error message
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return back()->with($notification);
    }

    public function update_employee(Request $request, $id)
    {
        //changing data of specific id
        $user_detail = Employee::find($id);

        //setting image to ''
        $image_name = "";


        //checking if image has selected 
        if ($request->hasFile('employee_feature_img')) {

            //validating image (filetypes:jpg,png, maxsize:2MB)
            $request->validate([
                'employee_feature_img' => 'mimes:jpg,png|max:2048'
            ]);

            //deleting the previous Image
            Storage::disk('public')->delete('employees/' . $user_detail->employee_feature_img);

            //getting the image name
            $image_full_name = $request->employee_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->employee_feature_img->storeAs('employees', $image_name, 'public');
        } else {

            //if image has not changed then uploading same image name to data base
            $image_name = $user_detail->employee_feature_img;
        }

        //updating values in database

        $user_detail->employee_phone = $request->employee_phone;

        $user_detail->employee_address = $request->employee_address;

        $user_detail->employee_feature_img = $image_name;

        if ($user_detail->save()) {
            //setting up success message
            $notification = array(
                'message' => 'Changes Saved!',
                'alert-type' => 'success'
            );
        } else {
            //setting up error message
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
