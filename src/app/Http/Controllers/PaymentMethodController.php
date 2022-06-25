<?php

namespace App\Http\Controllers;

use App\Classes\PhoneFormatter;
use App\Models\PaymentMethod;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_payment_methods = DB::table('standard_payment_methods')
            ->rightJoin('payment_methods', 'payment_methods.payment_title', 'standard_payment_methods.payment_title')
            ->select('standard_payment_methods.*', 'payment_methods.*', 'payment_methods.id as payment_method_id')
            ->get();

        $outlet_and_std_payment_methods = $all_payment_methods->map(
            function ($item) {
                if ($item->outlet_id == session('outlet_id') || $item->outlet_id == 0) {
                    return $item;
                }
            }
        );
        $outlet_and_std_payment_methods = $outlet_and_std_payment_methods->filter(
            function ($item) {
                return $item != null;
            }
        );

        $payment_methods = $outlet_and_std_payment_methods->unique('payment_title');


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

        return view('pages.payment-methods.index', compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_types = PaymentType::where('outlet_id', session('outlet_id'))->select('id', 'title')->get();
        return view('pages.payment-methods.add', compact('payment_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->has('active')) {
            if ($this->paymentMethodSwitch($request)) {
                $notification = array(
                    'message' => 'Changes Saved!',
                    'alert-type' => 'success'
                );
            }
        } else if ($request->has('payment_title')) {
            $request->validate([
                'payment_title' => [
                    'required', Rule::unique('payment_methods')->where(function ($query) {
                        $query->where('outlet_id', session('outlet_id'));
                    })
                ],
            ]);


            $formatted_phone = new Request([
                'phone' => PhoneFormatter::format_number($request->phone)
            ]);

            if ($formatted_phone->phone != '') {
                $this->validate(
                    $formatted_phone,
                    [
                        'phone' => ['regex:/(92)[0-9]{10}/'],
                    ],
                    [
                        'phone.regex' => "Please enter valid phone number.",
                    ]
                );
            }

            // dd($formatted_phone->phone);
            $payment_type = PaymentType::where('value', 0)->where('outlet_id', session('outlet_id'))->first();
            $payment_mehtod = new PaymentMethod([
                'payment_title' => $request->payment_title,
                'payment_type_id' => $payment_type->id,
                'phone' => $formatted_phone->phone,
                'address' => $request->address,
                'payment_description' => $request->payment_description,
                'outlet_id' => $request->outlet_id,
                'created_by' => $request->created_by,
            ]);

            //setting up success message
            if ($payment_mehtod->save()) {
                $notification = array(
                    'message' => 'Payment Method added successfully!',
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
        } else {
            $notification = array(
                'message' => 'There sould be more than one payment method!',
                'alert-type' => 'error'
            );
        }
        //redirecting to the page with notification message
        return back()->with($notification);
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

        $payment_method = PaymentMethod::where('id', $id)
            ->where('outlet_id', session('outlet_id'))->firstOrFail();
        return view('pages.payment-methods.edit', compact('payment_method'));
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
        $request->validate(
            [
                'payment_title' => [
                    'required', Rule::unique('payment_methods')->where(function ($query) use ($id) {
                        $query->where('outlet_id', session('outlet_id'))
                            ->where('id', '!=', $id);
                    })
                ],
            ],
            [
                'payment_type_id.required' => 'Payment type is required'
            ]
        );

        $formatted_phone = new Request([
            'phone' => PhoneFormatter::format_number($request->phone)
        ]);

        if ($formatted_phone->phone != '') {
            $this->validate(
                $formatted_phone,
                [
                    'phone' => ['regex:/(92)[0-9]{10}/'],
                ],
                [
                    'phone.regex' => "Please enter valid phone number.",
                ]
            );
        }

        $payment_method = PaymentMethod::where('id', $id)
            ->where('outlet_id', session('outlet_id'))->firstOrFail();



        $payment_method->payment_title = $request->payment_title;
        $payment_method->payment_type_id = $request->payment_type_id;
        $payment_method->phone = $formatted_phone->phone;
        $payment_method->address = $request->address;
        $payment_method->payment_description = $request->payment_description;
        $payment_method->outlet_id = $request->outlet_id;
        $payment_method->created_by = $request->created_by;

        //setting up success message
        if ($payment_method->save()) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment_method = PaymentMethod::where('id', $id)
            ->where('outlet_id', session('outlet_id'))->firstOrFail();
        if (count($payment_method->customer_accounts) > 0) {
            $notification = array(
                'message' => 'Payment method is in use!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        } else if (count($payment_method->supplier_accounts) > 0) {
            $notification = array(
                'message' => 'Payment method is in use!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        } else if (count($payment_method->sales_orders) > 0) {
            $notification = array(
                'message' => 'Payment method is in use!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        } else if (count($payment_method->purchase_orders) > 0) {
            $notification = array(
                'message' => 'Payment method is in use!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        } else if (count($payment_method->expense_transactions) > 0) {
            $notification = array(
                'message' => 'Payment method is in use!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        } else if (count($payment_method->party_accounts) > 0) {
            $notification = array(
                'message' => 'Payment method is in use!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        } else {
            //setting up success message
            if ($payment_method->delete()) {
                $notification = array(
                    'message' => 'Payment Method deleted successfully!',
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
        }

        //redirecting to the page with notification message
        return back()->with($notification);
    }

    protected function paymentMethodSwitch($request)
    {
        $new = '';

        foreach ($request->active as $active) {

            $standard_payment_methods = DB::table('standard_payment_methods')
                ->where('payment_title', $active)->first();

            $standard_payment_types = DB::table('standard_payment_types')
                ->where('id', $standard_payment_methods->payment_type_id)->first();

            $payment_type = PaymentType::firstOrCreate(
                [
                    'title' => $standard_payment_types->title,
                    'outlet_id' => session('outlet_id'),
                ],
                [
                    'title' => $standard_payment_types->title,
                    'value' => $standard_payment_types->value,
                    'description' => $standard_payment_types->description,
                    'outlet_id' => session('outlet_id'),
                    'created_by' => session('employee_id'),
                ]
            );


            $new = PaymentMethod::firstOrCreate(
                [
                    'payment_title' => $active,
                    'outlet_id' => session('outlet_id'),
                ],
                [
                    'payment_title' => $standard_payment_methods->payment_title,
                    'payment_type_id' => $payment_type->id,
                    'payment_description' => $standard_payment_methods->payment_description,
                    'outlet_id' => session('outlet_id'),
                    'created_by' => session('employee_id'),
                ]
            );
        }


        $get_payment_methods = DB::table('standard_payment_methods')
            ->whereNotIn('payment_title', $request->active)
            ->pluck('payment_title');
        $delete_payment_methods = PaymentMethod::leftJoin('payment_types', 'payment_types.id', 'payment_methods.payment_type_id')
            ->where('payment_types.value', '!=', 1)
            ->whereIn('payment_title', $get_payment_methods)
            ->where('payment_methods.outlet_id', session('outlet_id'))
            ->select('payment_methods.*')
            ->get();


        foreach ($delete_payment_methods as $delete_payment) {

            if (count($delete_payment->customer_accounts) > 0) {
                $notification = array(
                    'message' => 'Payment method is in use!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            } else if (count($delete_payment->supplier_accounts) > 0) {
                $notification = array(
                    'message' => 'Payment method is in use!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            } else if (count($delete_payment->sales_orders) > 0) {
                $notification = array(
                    'message' => 'Payment method is in use!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            } else if (count($delete_payment->purchase_orders) > 0) {
                $notification = array(
                    'message' => 'Payment method is in use!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            } else if (count($delete_payment->expense_transactions) > 0) {
                $notification = array(
                    'message' => 'Payment method is in use!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            } else if (count($delete_payment->party_accounts) > 0) {
                $notification = array(
                    'message' => 'Payment method is in use!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            } else {
                $delete_payment->delete();
                // $delete_payment2 = PaymentMethod::where('id', $delete_payment->id)->first();
                // dd($delete_payment2);
            }
        }
        //setting up success message
        if ($new != '') {

            return 1;
        }
    }


    // public function get_standard_payment_methods()
    // {
    //     $payment_methods = PaymentMethod::where('payment_methods.outlet_id', session('outlet_id'))
    //         ->pluck('payment_methods.payment_title');

    //     $standard_payment_methods = DB::table('standard_payment_methods')
    //         ->whereNotIn('standard_payment_methods.payment_title', $payment_methods)
    //         ->join('standard_payment_types', 'standard_payment_types.id', 'standard_payment_methods.payment_type_id')
    //         ->select('standard_payment_methods.*', 'standard_payment_types.title as payment_type_title')
    //         ->get();

    //     return view('pages.payment-methods.import_standard_payment_methods', compact('standard_payment_methods'));
    // }

    // public function store_standard_payment_methods(Request $request)
    // {

    //     if ($request->payment_method_id == '') {
    //         $notification = array(
    //             'message' => 'Please select atleast 1 record',
    //             'alert-type' => 'error'
    //         );
    //         return redirect()->back()->with($notification);
    //     }
    //     DB::transaction(function () use ($request) {
    //         $standard_payment_methods = DB::table('standard_payment_methods')
    //             ->whereIn('standard_payment_methods.id', $request->payment_method_id)
    //             ->join('standard_payment_types', 'standard_payment_types.id', 'standard_payment_methods.payment_type_id')
    //             ->select('standard_payment_methods.*', 'standard_payment_types.title as payment_type_title', 'standard_payment_types.value as payment_type_value')
    //             ->get();
    //         // dd($standard_payment_methods);
    //         foreach ($standard_payment_methods as $standard_payment_method) {
    //             $payment_type = PaymentType::firstOrCreate(
    //                 [
    //                     'title' => $standard_payment_method->payment_type_title,
    //                     'outlet_id' => session('outlet_id')
    //                 ],
    //                 [
    //                     'title' => $standard_payment_method->payment_type_title,
    //                     'value' => $standard_payment_method->payment_type_value,
    //                     'outlet_id' => session('outlet_id'),
    //                     'created_by' => session('employee_id'),
    //                 ]
    //             );
    //             $payment_mehtod = PaymentMethod::firstOrCreate(
    //                 [
    //                     'payment_title' => $standard_payment_method->payment_title,
    //                     'outlet_id' => session('outlet_id')
    //                 ],
    //                 [
    //                     'payment_title' => $standard_payment_method->payment_title,
    //                     'payment_type_id' => $payment_type->id,
    //                     'payment_description' => $standard_payment_method->payment_description,
    //                     'outlet_id' => session('outlet_id'),
    //                     'created_by' => session('employee_id'),
    //                 ]
    //             );
    //         }
    //     });
    //     if (DB::transactionLevel() == 0) {
    //         $notification = array(
    //             'message' => 'Payment Methods Imported',
    //             'alert-type' => 'success'
    //         );
    //         //setting up succes message
    //     } else {
    //         $notification = array(
    //             'message' => 'Something went wrong',
    //             'alert-type' => 'error'
    //         );
    //     }
    //     return redirect()->route('payment-methods.index')->with($notification);
    // }
}
