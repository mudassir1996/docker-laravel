<?php

namespace App\Http\Controllers\Airlines;

use App\Http\Controllers\Controller;
use App\Models\Airlines\OutletDiscount;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet_discounts = OutletDiscount::where('outlet_discounts.outlet_id', session('outlet_id'))
            ->leftJoin('employees', 'employees.id', 'outlet_discounts.created_by')
            ->select('outlet_discounts.*', 'employees.employee_name')
            ->get();

        return view('pages.airlines.discounts.index', compact('outlet_discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.airlines.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'discount_title' => [
                'required', Rule::unique('outlet_discounts')->where(function ($query) {
                    $query->where('outlet_id', session('outlet_id'));
                })
            ],
            'discount_value' => 'required|integer',
            'discount_type' => 'required',
            'discount_status' => 'required',
        ]);

        $outlet_discount = new OutletDiscount([
            'discount_title' => $request->discount_title,
            'discount_value' => $request->discount_value,
            'discount_type' => $request->discount_type,
            'discount_status' => $request->discount_status,
            'discount_description' => $request->discount_description,
            'outlet_id' => session('outlet_id'),
            'created_by' => session('employee_id'),
        ]);

        //setting up success message
        if ($outlet_discount->save()) {
            $notification = array(
                'message' => 'Discount added successfully!',
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
        return redirect()->route('outlet-discounts.index')->with($notification);
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
        $outlet_discount = OutletDiscount::where('outlet_id', session('outlet_id'))->where('id', $id)->firstOrFail();
        return view('pages.airlines.discounts.edit', compact('outlet_discount'));
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
            'discount_title' => [
                'required', Rule::unique('outlet_discounts')->where(function ($query) use ($id) {
                    $query->where('outlet_id', session('outlet_id'))
                        ->where('id', '!=', $id);
                })
            ],
            'discount_value' => 'required|numeric',
            'discount_type' => 'required',
            'discount_status' => 'required',
        ]);

        $outlet_discount = OutletDiscount::where('outlet_id', session('outlet_id'))->where('id', $id)->firstOrFail();
        $outlet_discount->update([
            'discount_title' => $request->discount_title,
            'discount_value' => $request->discount_value,
            'discount_type' => $request->discount_type,
            'discount_status' => $request->discount_status,
            'discount_description' => $request->discount_description,
            'outlet_id' => session('outlet_id'),
            'created_by' => session('employee_id'),
        ]);

        //setting up success message
        if ($outlet_discount) {
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
        return redirect()->route('outlet-discounts.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outlet_discount = OutletDiscount::where('outlet_id', session('outlet_id'))->where('id', $id)->firstOrFail();
        //setting up success message
        if ($outlet_discount->delete()) {
            $notification = array(
                'message' => 'Discount deleted successfully!',
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
        return redirect()->route('outlet-discounts.index')->with($notification); //
    }


    /**
     * Get discount data
     *
     * @param  Request $request
     * @return json
     */
    public function get_discount(Request $request)
    {
        $discount = OutletDiscount::where('id', $request->id)->where('outlet_id', session('outlet_id'))->first();
        return response()->json($discount);
    }
}
