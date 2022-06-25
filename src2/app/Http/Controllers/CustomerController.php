<?php

namespace App\Http\Controllers;

use App\Classes\Subscriber;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\DataSync;
use App\Models\Sales\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('customer_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        // $customers = Customer::where('outlet_id', session('outlet_id'))->get();
        $customers = DB::table('customers')
            ->select('customers.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'customers.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'customers.created_by', '=', 'employees.id')
            ->where('customers.outlet_id', session('outlet_id'))
            ->latest()
            ->get();
        // dd($customers);

        return view('pages.customer.customers', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('customer_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        return view('pages.customer.add_customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }



        //validating image (filetypes:jpg,png, maxsize:2MB)
        $request->validate(
            [
                'customer_name' => 'required',
                'customer_feature_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'customer_name.required' => 'Customer name is required.',
            ]
        );
        if ($request->customer_phone != '' || $request->customer_phone != null) {
            $request->validate(
                [
                    'customer_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                ],
                [
                    'customer_phone.regex' => 'Phone number is invalid.',
                ]
            );
        }

        if ($request->hasFile('customer_feature_img')) {
            //getting the image name
            $image_full_name = $request->customer_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->customer_feature_img->storeAs('customers', $image_name, 'public');
        } else {
            $image_name = 'placeholder.jpg';
        }
        $customer_dob = $request->get('customer_dob');
        if ($customer_dob != '') {
            $customer_dob = $request->get('customer_dob');
        }

        //adding data to products
        $customer = new Customer(
            [
                'customer_name' => $request->get('customer_name'),
                'customer_gender' => $request->get('customer_gender'),
                'customer_description' => $request->get('customer_description'),
                'customer_phone' => $request->get('customer_phone'),
                'customer_dob' => $request->get('customer_dob') ?? NULL,
                'customer_email' => $request->get('customer_email'),
                'allow_credit' => $request->get('allow_credit') ?? 0,
                'customer_address' => $request->get('customer_address'),
                'customer_cnic' => $request->get('customer_cnic'),
                'customer_feature_img' => $image_name,
                'outlet_id' => $request->get('outlet_id'),
                'created_by' => $request->get('created_by'),
            ]
        );



        // //setting up success message
        if ($customer->save()) {
            $notification = array(
                'message' => 'Customer added successfully!',
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

        return redirect('outlets/customers')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('customer_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $customer = Customer::leftJoin('outlets', 'customers.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'customers.created_by', '=', 'employees.id')
            ->select('customers.*', 'outlets.outlet_title', 'employees.employee_name')
            ->where('customers.outlet_id', session('outlet_id'))
            ->where('customers.id', $id)
            ->firstOrFail();

        $sales_orders = SalesOrder::leftJoin('customers', 'customers.id', 'sales_orders.customer_id')
            ->leftJoin('payment_types', 'payment_types.id', 'sales_orders.payment_type')
            ->where('sales_orders.customer_id', $customer->id)
            ->where('sales_orders.so_status', 'completed')
            ->select('sales_orders.id', 'sales_orders.order_completion_date', 'sales_orders.amount_payable', 'payment_types.title as payment_type_title')
            ->orderByDesc('sales_orders.id')
            ->get();

        $customer_accounts = CustomerAccount::where('customer_id', $customer->id)
            ->leftJoin('payment_types', 'payment_types.id', 'customer_accounts.payment_type')
            ->where('customer_accounts.outlet_id', session('outlet_id'))
            ->orderByDesc('customer_accounts.id')
            ->select('customer_accounts.id', 'customer_accounts.payment_date', 'customer_accounts.amount', 'customer_accounts.balance', 'payment_types.title as payment_type_title')
            ->get();

        $balance = CustomerAccount::where('customer_id', $customer->id)->select('balance')->latest()->first();

        return view('pages.customer.view_customer', compact('customer', 'balance', 'sales_orders', 'customer_accounts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('customer_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $customer = Customer::where('customers.outlet_id', session('outlet_id'))
            ->where('customers.id', $id)
            ->firstOrFail();
        return view('pages.customer.edit_customer', compact('customer'));
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
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        //changing data of specific id
        $customer = Customer::where('customers.outlet_id', session('outlet_id'))
            ->where('customers.id', $id)
            ->firstOrFail();

        //setting image to ''
        $image_name = "";

        //validating image (filetypes:jpg,png, maxsize:2MB)
        $request->validate(
            [
                'customer_name' => 'required',
                'customer_feature_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'customer_name.required' => 'Customer name is required.',
            ]
        );
        if ($request->customer_phone != '' || $request->customer_phone != null) {
            $request->validate(
                [
                    'customer_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                ],
                [
                    'customer_phone.regex' => 'Phone number is invalid.',
                ]
            );
        }

        //checking if image has selected 
        if ($request->hasFile('customer_feature_img')) {

            //deleting the previous Image
            Storage::disk('public')->delete('customers/' . $customer->customer_feature_img);

            //getting the image name
            $image_full_name = $request->customer_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->customer_feature_img->storeAs('customers', $image_name, 'public');
        } else {

            //if image has not changed then uploading same image name to data base
            $image_name = $customer->customer_feature_img;
        }

        $customer_dob = $request->get('customer_dob');
        if ($customer_dob != '') {
            $customer_dob = $request->get('customer_dob');
        }

        //updating values in database
        $customer->customer_name = $request->get('customer_name');
        $customer->customer_gender = $request->get('customer_gender');
        $customer->customer_phone = $request->get('customer_phone');
        $customer->customer_dob = $request->get('customer_dob') ?? NULL;
        $customer->customer_email = $request->get('customer_email');
        $customer->allow_credit = $request->get('allow_credit') ?? 0;
        $customer->customer_address = $request->get('customer_address');
        $customer->customer_feature_img = $image_name;
        $customer->customer_cnic = $request->get('customer_cnic');
        $customer->customer_description = $request->get('customer_description');
        $customer->outlet_id = $request->get('outlet_id');
        $customer->created_by = $request->get('created_by');

        if ($customer->save()) {
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
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('customer_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $customer = Customer::where('customers.outlet_id', session('outlet_id'))
            ->where('customers.id', $id)
            ->firstOrFail();

        if (count($customer->sales_orders) > 0 || count($customer->customer_accounts) > 0) {
            $notification = array(
                'message' => 'Customer is already in use!',
                'alert-type' => 'error'
            );
            return redirect('/outlets/customers')->with($notification);
        }

        //deleting the image from the storage
        Storage::disk('public')->delete('customers/' . $customer->customer_feature_img);

        DB::transaction(function () use ($id, $customer) {
            if ($customer->delete()) {
                DataSync::create([
                    'record_id' => $id,
                    'table_name' => 'customers',
                    'action' => 'delete',
                    'outlet_id' => session('outlet_id')
                ]);
            }
        });

        //setting up succes message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Customer Deleted!',
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
        return redirect('outlets/customers')->with($notification);
    }

    public function add_customer_ajax(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('customer_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $request->validate(
            [
                'customer_name' => 'required',
            ],
            [
                'customer_name.required' => 'Please enter a customer name.',
            ]
        );
        $customer = Customer::create(
            [
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'allow_credit' => $request->allow_credit ?? 0,
                'customer_feature_img' => 'placeholder.jpg',
                'created_by' => session('employee_id'),
                'outlet_id' => session('outlet_id'),
            ]
        );
        return response()->json($customer->id);
    }

    public function get_customer(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('customer_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $customer = Customer::where('id', $request->id)->where('outlet_id', session('outlet_id'))->select('id', 'customer_name', 'customer_phone', 'customer_address', 'allow_credit')->first();
        return response()->json($customer);
    }
}
