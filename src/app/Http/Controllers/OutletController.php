<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\EmployeeLogin;
use App\Models\ExpenseCategory;
use App\Models\Outlet;
use App\Models\OutletSetting;
use App\Models\PaymentMethod;
use App\Models\PaymentType;
use App\Models\Permissions;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Roles;
use App\Models\Subscription;
use App\Models\UserDetail;
use Carbon\Carbon;
use Database\Seeders\OutletSettingSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class OutletController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // abort_if(Gate::denies('outlets_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('outlet_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        // $permissions = Permissions::pluck('id');
        // dd($permissions);
        $request->session()->forget('outlet_id');
        $request->session()->forget('employee_id');
        $request->session()->forget('outlet_title');
        $request->session()->forget('outlet_address');
        $request->session()->forget('outlet_phone');
        $bg_class = array(
            'bg-success bg-hover-state-success',
            'bg-info bg-hover-state-info',
            'bg-danger bg-hover-state-danger',
            'bg-dark bg-hover-state-dark',
            'bg-primary bg-hover-state-primary',
            'bg-warning bg-hover-state-warning',
        );
        if (Auth::guard('web')->check()) {
            $outlets = Outlet::where('outlets.created_by', Auth::user()->id)
                ->join('cities', 'outlets.outlet_city', 'cities.id')
                ->join('outlet_statuses', 'outlets.outlet_status_id', 'outlet_statuses.id')
                ->orderByDesc('outlets.id')
                ->select('outlets.*', 'cities.city_name', 'outlet_statuses.status_title as outlet_status', 'outlet_statuses.status_value')
                ->get();
            // dd(Outlet::all());
        } elseif (Auth::guard('employee')->check()) {
            $outlets = Employee::where('employees.id', Auth::user()->employee_id)
                ->join('outlets', 'outlets.id', 'employees.outlet_id')
                ->join('cities', 'outlets.outlet_city', 'cities.id')
                ->join('outlet_statuses', 'outlets.outlet_status_id', 'outlet_statuses.id')
                ->orderByDesc('outlets.id')
                ->select('outlets.*', 'cities.city_name', 'outlet_statuses.status_title as outlet_status', 'outlet_statuses.status_value')
                ->get();

            // dd($outlets);

            $products = Product::where('outlet_id', $outlets->first()->id)->count();
            return view('pages.outlet.outlets', compact('outlets', 'products', 'bg_class'));
        }
        return view('pages.outlet.outlets', compact('outlets', 'bg_class'));
        // dd($products);
    }

    public function open_outlet(Request $request)
    {

        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('outlet_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $employee_id = Auth::user()->employee_id;
        } else {
            $employee_id = Employee::where('outlet_id', $request->outlet_id)->pluck('id')->first();
        }

        $request->session()->put('outlet_id', $request->outlet_id);
        $request->session()->put('employee_id', $employee_id);
        $request->session()->put('outlet_title', $request->outlet_title);
        $request->session()->put('outlet_address', Crypt::decrypt($request->outlet_address));
        $request->session()->put('outlet_phone', Crypt::decrypt($request->outlet_phone));

        if (!OutletSetting::where('outlet_id', $request->outlet_id)->exists()) {
            $outlet_setting_seeder = new OutletSettingSeeder();
            $outlet_setting_seeder->run([
                'outlet_id' => $request->outlet_id,
                'created_by' => $employee_id,
            ]);
        }

        return redirect('/outlets/dashboard');
    }

    public function getState(Request $request)
    {
        $states = DB::table('states')->where('country_id', $request->country_id)->pluck('id', 'state_name');
        return response()->json($states);
    }

    public function getCity(Request $request)
    {
        $cities = DB::table('cities')->where('state_id', $request->state_id)->pluck('id', 'city_name');
        return response()->json($cities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort_if(Gate::denies('outlets_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('outlet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $businesses = DB::table('businesses')->orderBy('business_title', 'asc')->get();
        $countries = DB::table('countries')->get();
        $standard_categories = DB::table('standard_categories')->get();
        $standard_products = DB::table('standard_products')->get();
        $standard_companies = DB::table('standard_companies')->get();
        $standard_expense_categories = DB::table('standard_expense_categories')->get();
        $standard_payment_types = DB::table('standard_payment_types')->get();
        $standard_payment_methods = DB::table('standard_payment_methods')
            ->leftJoin('standard_payment_types', 'standard_payment_types.id', 'standard_payment_methods.payment_type_id')
            ->where('standard_payment_types.value', '!=', '1')
            ->select('standard_payment_methods.*')
            ->get();
        $plans = DB::table('plans')->get();

        //check free outlets
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
            $notification = array(
                'message' => 'Free outlet limit exceeded!',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }
        return view('pages.outlet.add_outlet', compact('countries', 'businesses', 'standard_categories', 'standard_products', 'standard_companies', 'standard_expense_categories', 'standard_payment_types', 'standard_payment_methods', 'plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('outlet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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

        if ($request->hasFile('outlet_feature_img')) {
            //getting the image name
            $image_full_name = $request->outlet_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->outlet_feature_img->storeAs('outlets', $image_name, 'public');
        } else {
            $image_name = 'placeholder.jpg';
        }



        DB::transaction(function () use ($request, $image_name) {
            //adding data
            $outlet = new Outlet(
                [
                    'outlet_title' => $request->get('outlet_title'),
                    'is_supplier' => $request->get('is_supplier') ?? 0,
                    'public_key' => $request->get('public_key'),
                    'outlet_slogan' => $request->get('outlet_slogan'),
                    'outlet_description' => $request->get('outlet_description'),
                    'outlet_phone' => $request->get('outlet_phone'),
                    'outlet_alt_phone' => $request->get('outlet_alt_phone'),
                    'outlet_email' => $request->get('outlet_email') ?? auth()->user()->email,
                    'outlet_address' => $request->get('outlet_address'),
                    'outlet_city' => $request->get('outlet_city'),
                    'outlet_state' => $request->get('outlet_state'),
                    'outlet_country' => $request->get('outlet_country'),
                    'outlet_feature_img' => $image_name,
                    'outlet_opening_date' => $request->get('outlet_opening_date') ?? Carbon::now(),
                    'outlet_registration_date' => Carbon::now(),
                    'location_point_id' => 1,
                    'business_type_id' => $request->get('business_type_id'),
                    'outlet_status_id' => 1,
                    'created_by' => Auth::user()->id,
                ]
            );

            //setting up success message
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

                if ($request->has('categories')) {
                    $categories = DB::table('standard_categories')
                        ->whereIn('id', $request->categories)
                        ->get();
                    $new_category = array();
                    foreach ($categories as $category) {
                        $new_category[] = [
                            'category_title' => $category->title,
                            'category_description' => $category->description,
                            'category_feature_img' => $category->featured_img,
                            'created_at' => Carbon::now(),
                            'updated_at' =>  Carbon::now(),
                            'outlet_id' => $outlet->id,
                            'created_by' => $employee->id
                        ];
                    }
                    Category::insert($new_category);
                }
                if ($request->has('companies')) {
                    $companies = DB::table('standard_companies')
                        ->whereIn('id', $request->companies)
                        ->get();
                    $new_company = array();
                    foreach ($companies as $company) {
                        $new_company[] = [
                            'company_title' => $company->title,
                            'company_address' => $company->address,
                            'company_email' => $company->email,
                            'company_phone' => $company->phone,
                            'company_description' => $company->description,
                            'company_feature_img' => $company->featured_img,
                            'created_at' => Carbon::now(),
                            'updated_at' =>  Carbon::now(),
                            'outlet_id' => $outlet->id,
                            'created_by' => $employee->id
                        ];
                    }
                    Company::insert($new_company);
                    // dd($new_company);
                }
                if ($request->has('expense_categories')) {
                    $expense_categories = DB::table('standard_expense_categories')
                        ->whereIn('id', $request->expense_categories)
                        ->get();
                    $new_expense_category = array();
                    foreach ($expense_categories as $expense_category) {
                        $new_expense_category[] = [
                            'title' => $expense_category->title,
                            'description' => $expense_category->description,
                            'feature_img' => $expense_category->featured_img,
                            'created_at' => Carbon::now(),
                            'updated_at' =>  Carbon::now(),
                            'outlet_id' => $outlet->id,
                            'created_by' => $employee->id
                        ];
                    }
                    ExpenseCategory::insert($new_expense_category);
                    // dd($new_expense_category);
                }
                if ($request->has('payment_types')) {
                    $payment_types = DB::table('standard_payment_types')
                        ->whereIn('id', $request->payment_types)
                        ->get();

                    foreach ($payment_types as $payment_type) {
                        $new_payment_type = PaymentType::create([
                            'title' => $payment_type->title,
                            'description' => $payment_type->description,
                            'value' => $payment_type->value,
                            'outlet_id' => $outlet->id,
                            'created_by' => $employee->id
                        ]);
                        // $new_payment_type->save();
                        if ($payment_type->value == '1') {
                            $credit_method = DB::table('standard_payment_methods')
                                ->where('payment_type_id', $payment_type->id)
                                ->first();
                            PaymentMethod::create([
                                'payment_title' => $credit_method->payment_title,
                                'payment_type_id' => $new_payment_type->id,
                                'payment_description' => $credit_method->payment_description,
                                'outlet_id' => $outlet->id,
                                'created_by' => $employee->id
                            ]);
                        }
                    }
                    // dd($new_payment_type);
                }
                if ($request->has('payment_methods')) {
                    $payment_methods = DB::table('standard_payment_methods')
                        ->whereIn('standard_payment_methods.id', $request->payment_methods)
                        ->leftJoin('standard_payment_types', 'standard_payment_types.id', 'standard_payment_methods.payment_type_id')
                        ->select(
                            'standard_payment_methods.*',
                            'standard_payment_types.title as payment_type_title',
                            'standard_payment_types.value as payment_type_value',
                            'standard_payment_types.description as payment_type_description'
                        )
                        ->get();
                    foreach ($payment_methods as $payment_method) {
                        $payment_type = PaymentType::firstOrCreate(
                            [
                                'title' => $payment_method->payment_type_title,
                                'outlet_id' => $outlet->id,
                            ],
                            [
                                'title' => $payment_method->payment_type_title,
                                'value' => $payment_method->payment_type_value,
                                'description' => $payment_method->payment_type_description,
                                'outlet_id' => $outlet->id,
                                'created_by' => $employee->id
                            ]
                        );
                        $new_payment_method = PaymentMethod::create(
                            [
                                'payment_title' => $payment_method->payment_title,
                                'payment_type_id' => $payment_type->id,
                                'payment_description' => $payment_method->payment_description,
                                'outlet_id' => $outlet->id,
                                'created_by' => $employee->id
                            ]
                        );
                    }
                }
                if ($request->has('products')) {
                    $products = DB::table('standard_products')->whereIn('id', $request->products)
                        ->get();
                    foreach ($products as $product) {
                        $category = Category::firstOrCreate(
                            [
                                'category_title' => $product->category,
                                'outlet_id' =>  $outlet->id
                            ],
                            [
                                'category_title' => $product->category,
                                'category_feature_img' => 'placeholder.jpg',
                                'outlet_id' => $outlet->id,
                                'created_by' => $employee->id,
                            ]
                        );
                        $company = Company::firstOrCreate(
                            [
                                'company_title' => $product->company,
                                'outlet_id' => $outlet->id
                            ],
                            [
                                'company_title' => $product->company,
                                'company_feature_img' => 'placeholder.jpg',
                                'outlet_id' => $outlet->id,
                                'created_by' => $employee->id,
                            ]
                        );
                        $new_product = Product::create(
                            [
                                'product_title' => $product->product_title,
                                'product_barcode' => $product->product_barcode,
                                'product_description' => $product->product_description,
                                'category_id' => $category->id,
                                'company_id' => $company->id,
                                'product_status' => $product->status,
                                'product_allow_half' => $product->product_allow_half,
                                'product_feature_img' => $product->featured_img,
                                'outlet_id' => $outlet->id,
                                'created_by' => $employee->id,
                            ]
                        );

                        ProductStock::create([
                            'product_id' => $new_product->id,
                            'cost_price' => $product->cost_price,
                            'retail_price' => $product->retail_price,
                            'stock_keeping' => $product->stock_keeping,
                            'units_in_stock' => 0,
                            'sku' => 0,
                            'minimum_threshold' => 0,
                            'outlet_id' => $outlet->id,
                            'created_by' => $employee->id,
                        ]);
                    }
                }

                if ($request->subscription_plan != 'free') {
                    $plan = DB::table('plans')->where('id', $request->subscription_plan)->select('subscription_duration', 'plan_amount')->first();

                    $start_date = Carbon::now()->format('Y-m-d H:i:s');
                    $end_date = Carbon::now()->addDays($plan->subscription_duration)->format('Y-m-d H:i:s');
                    $total_bill = $plan->plan_amount;

                    $subscription = new Subscription;

                    $subscription->outlet_id = $outlet->id;
                    $subscription->plan_id = $request->subscription_plan;
                    $subscription->payment_method = $request->subscription_payment_method;
                    $subscription->total_bill = $total_bill;
                    $subscription->discount_amount = $request->discount_amount ?? '0.00';
                    $subscription->paid_bill = $total_bill;
                    $subscription->subscription_start_date = $start_date;
                    $subscription->subscription_end_date = $end_date;
                    $subscription->subscription_status = 'unverified';
                    $subscription->creater_user_type = 'customer';
                    $subscription->created_by = Auth::user()->id;
                    $subscription->remarks = "Subscription added by customer";
                    $subscription->save();
                }

                $outlet_setting_seeder = new OutletSettingSeeder();
                $outlet_setting_seeder->run([
                    'outlet_id' => $outlet->id,
                    'created_by' => $employee->id,
                ]);
            }
        });

        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Outlet added successfully!',
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
        return redirect('/outlets')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $outlet = Outlet::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // abort_if(Gate::denies('outlets_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('outlet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $outlet = Outlet::find($id);
        $businesses = DB::table('businesses')->get();
        $statuses = DB::table('outlet_statuses')->get();
        $countries = DB::table('countries')->get();
        return view('pages.outlet.edit_outlet', compact('outlet', 'countries', 'businesses', 'statuses'));
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
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('outlet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        //changing data of specific id
        $outlet = Outlet::find($id);

        //setting image to ''
        $image_name = "";


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

        //checking if image has selected 
        if ($request->hasFile('outlet_feature_img')) {


            //deleting the previous Image
            Storage::disk('public')->delete('outlets/' . $outlet->outlet_feature_img);

            //getting the image name
            $image_full_name = $request->outlet_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->outlet_feature_img->storeAs('outlets', $image_name, 'public');
        } else {

            //if image has not changed then uploading same image name to data base
            $image_name = $outlet->outlet_feature_img;
        }


        //updating values in database
        $outlet->outlet_title = $request->get('outlet_title');
        $outlet->outlet_slogan = $request->get('outlet_slogan');
        $outlet->outlet_description = $request->get('outlet_description');
        $outlet->outlet_phone = $request->get('outlet_phone');
        $outlet->outlet_alt_phone = $request->get('outlet_alt_phone');
        $outlet->outlet_email = $request->get('outlet_email');
        $outlet->outlet_feature_img = $image_name;
        $outlet->outlet_address = $request->get('outlet_address');
        $outlet->outlet_city = $request->get('outlet_city');
        $outlet->outlet_state = $request->get('outlet_state');
        $outlet->outlet_country = $request->get('outlet_country');
        $outlet->outlet_opening_date = $request->get('outlet_opening_date');
        $outlet->business_type_id = $request->get('business_type_id');
        $outlet->created_by = $request->get('created_by');

        if ($outlet->save()) {
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
}
