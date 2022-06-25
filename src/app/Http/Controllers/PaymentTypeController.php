<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\PaymentType;
use Faker\Provider\ar_SA\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $standard_payment_types = DB::table('standard_payment_types')->get();

        $payment_types = $standard_payment_types->map(function ($item) {
            $payment_type = PaymentType::where('payment_types.outlet_id', session('outlet_id'))
                ->where('title', $item->title)
                ->first();
            if ($payment_type) {
                $item->active = 1;
            } else {
                $item->active = 0;
            }
            return $item;
        });

        return view('pages.payment-types.index', compact('payment_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.payment-types.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new = '';
        if ($request->active != '') {
            foreach ($request->active as $active) {
                $standard_payment_types = DB::table('standard_payment_types')
                    ->where('title', $active)->first();

                $new = PaymentType::firstOrCreate(
                    [
                        'title' => $active,
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

                if ($standard_payment_types->value == 1) {
                    $standard_payment_method = DB::table('standard_payment_methods')
                        ->where('payment_type_id', $standard_payment_types->id)->first();

                    PaymentMethod::firstOrCreate(
                        [
                            'payment_title' => $standard_payment_method->payment_title,
                            'outlet_id' => session('outlet_id'),
                        ],
                        [
                            'payment_title' => $standard_payment_method->payment_title,
                            'payment_type_id' => $new->id,
                            'payment_description' => $standard_payment_method->payment_description,
                            'outlet_id' => session('outlet_id'),
                            'created_by' => session('employee_id'),
                        ]
                    );
                }
            }

            $delete_payments = PaymentType::whereNotIn('title', $request->active)
                ->where('payment_types.outlet_id', session('outlet_id'))
                ->get();
        } else {
            $delete_payments = PaymentType::where('payment_types.outlet_id', session('outlet_id'))
                ->get();
        }
        // dd($delete_payments);

        foreach ($delete_payments as $delete_payment) {
            if (count($delete_payment->customer_accounts) > 0) {
                $notification = array(
                    'message' => 'Payment type is in use!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            } else if (count($delete_payment->supplier_accounts) > 0) {
                $notification = array(
                    'message' => 'Payment type is in use!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            } else if (count($delete_payment->sales_orders) > 0) {
                $notification = array(
                    'message' => 'Payment type is in use!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            } else if (count($delete_payment->purchase_orders) > 0) {
                $notification = array(
                    'message' => 'Payment type is in use!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            } else if (count($delete_payment->payment_methods) > 0) {
                $notification = array(
                    'message' => 'Payment type is in use!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            } else if (count($delete_payment->expense_transactions) > 0) {
                $notification = array(
                    'message' => 'Payment type is in use!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            } else if (count($delete_payment->party_accounts) > 0) {
                $notification = array(
                    'message' => 'Payment type is in use!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            } else {
                if ($delete_payment->delete()) {
                    $notification = array(
                        'message' => 'Payment Type deleted successfully!',
                        'alert-type' => 'success'
                    );
                }
            }
        }

        //setting up success message
        if ($new != '') {
            $notification = array(
                'message' => 'Changes Saved!',
                'alert-type' => 'success'
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
        $payment_type = PaymentType::where('id', $id)
            ->where('outlet_id', session('outlet_id'))->firstOrFail();
        return view('pages.payment-types.edit', compact('payment_type'));
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
        $request->validate([
            'title' => [
                'required', Rule::unique('payment_types')->where(function ($query) use ($id) {
                    $query->where('outlet_id', session('outlet_id'))
                        ->where('id', '!=', $id);
                })
            ],
            'value' => 'required|integer',

        ]);

        $payment_type = PaymentType::where('id', $id)
            ->where('outlet_id', session('outlet_id'))->firstOrFail();

        $payment_type->title = $request->title;
        $payment_type->description = $request->description;
        $payment_type->value = $request->value;
        $payment_type->outlet_id = $request->outlet_id;
        $payment_type->created_by = $request->created_by;

        //setting up success message
        if ($payment_type->save()) {
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
        return  back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment_type = PaymentType::where('id', $id)
            ->where('outlet_id', session('outlet_id'))->firstOrFail();
        //setting up success message
        if ($payment_type->delete()) {
            $notification = array(
                'message' => 'Payment type deleted successfully!',
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
        return redirect()->route('payment-types.index')->with($notification);
    }


    public function get_standard_payment_types()
    {
        $payment_types = PaymentType::where('outlet_id', session('outlet_id'))->pluck('title');
        $standard_payment_types = DB::table('standard_payment_types')->whereNotIn('title', $payment_types)->get();
        return view('pages.payment-types.import_standard_payment_types', compact('standard_payment_types'));
    }

    public function store_standard_payment_types(Request $request)
    {
        if ($request->payment_type_id == '') {
            $notification = array(
                'message' => 'Please select atleast 1 record',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        DB::transaction(function () use ($request) {
            $standard_payment_types = DB::table('standard_payment_types')->whereIn('id', $request->payment_type_id)->get();
            foreach ($standard_payment_types as $standard_payment_type) {
                $payment_type = PaymentType::firstOrCreate(
                    [
                        'title' => $standard_payment_type->title,
                        'outlet_id' => session('outlet_id')
                    ],
                    [
                        'title' => $standard_payment_type->title,
                        'description' => $standard_payment_type->description,
                        'value' => $standard_payment_type->value,
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]
                );
            }
        });
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Payment Types Imported',
                'alert-type' => 'success'
            );
            //setting up succes message
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('payment-types.index')->with($notification);
    }
}
