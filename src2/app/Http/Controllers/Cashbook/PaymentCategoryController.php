<?php

namespace App\Http\Controllers\Cashbook;

use App\Http\Controllers\Controller;
use App\Models\Cashbook\PaymentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class PaymentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('payment_category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $payment_categories = PaymentCategory::where('payment_categories.outlet_id', session('outlet_id'))
            ->join('employees', 'employees.id', 'payment_categories.created_by')
            ->select('payment_categories.*', 'employees.employee_name')
            ->get();
        return view('pages.cashbook.payment-categories.index', compact('payment_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.cashbook.payment-categories.create');
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
            abort_if(Gate::denies('payment_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $request->validate(
            [
                'payment_category_title' => [
                    'required', Rule::unique('payment_categories')->where(function ($query) {
                        $query->where('outlet_id', session('outlet_id'));
                    })
                ]
            ],
            [
                'payment_category_title.required' => 'Title is required.'
            ]
        );

        //adding data to products
        $payment_category = new PaymentCategory(
            [
                'payment_category_title' => $request->get('payment_category_title'),
                'payment_category_status' => $request->get('payment_category_status'),
                'payment_category_description' => $request->get('payment_category_description'),
                'outlet_id' => session('outlet_id'),
                'created_by' => session('employee_id')
            ]
        );

        //setting up success message
        if ($payment_category->save()) {
            $notification = array(
                'message' => 'Payment Category added successfully!',
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
        return redirect('/outlets/payment-categories')->with($notification);
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
        $payment_category = PaymentCategory::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();
        return view('pages.cashbook.payment-categories.edit', compact('payment_category'));
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
        $payment_category = PaymentCategory::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();
        $payment_category->payment_category_title = $request->get('payment_category_title');
        $payment_category->payment_category_status = $request->get('payment_category_status');
        $payment_category->payment_category_description = $request->get('payment_category_description');
        $payment_category->outlet_id = session('outlet_id');
        $payment_category->created_by = session('employee_id');

        //setting up success message
        if ($payment_category->save()) {
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
        return redirect('/outlets/payment-categories')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment_category = PaymentCategory::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();

        //setting up succes message
        if ($payment_category->delete()) {
            $notification = array(
                'message' => 'Payment Category Deleted!',
                'alert-type' => 'success'
            );
        }
        //setting up succes message
        else {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect('/outlets/payment-categories')->with($notification);
    }
}
