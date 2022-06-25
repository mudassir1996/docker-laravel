<?php

namespace App\Http\Controllers\Airlines;

use App\Http\Controllers\Controller;
use App\Models\Airlines\OutletTax;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet_taxes = OutletTax::where('outlet_taxes.outlet_id', session('outlet_id'))
            ->leftJoin('employees', 'employees.id', 'outlet_taxes.created_by')
            ->select('outlet_taxes.*', 'employees.employee_name')
            ->get();

        return view('pages.airlines.taxes.index', compact('outlet_taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.airlines.taxes.create');
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
            'tax_title' => [
                'required', Rule::unique('outlet_taxes')->where(function ($query) {
                    $query->where('outlet_id', session('outlet_id'));
                })
            ],
            'tax_value' => 'required|integer',
            'tax_type' => 'required',
            'tax_status' => 'required',
        ]);

        $outlet_tax = new OutletTax([
            'tax_title' => $request->tax_title,
            'tax_value' => $request->tax_value,
            'tax_type' => $request->tax_type,
            'tax_status' => $request->tax_status,
            'tax_description' => $request->tax_description,
            'outlet_id' => session('outlet_id'),
            'created_by' => session('employee_id'),
        ]);

        //setting up success message
        if ($outlet_tax->save()) {
            $notification = array(
                'message' => 'Tax added successfully!',
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
        return redirect()->route('outlet-taxes.index')->with($notification);
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
        $outlet_tax = OutletTax::where('outlet_id', session('outlet_id'))->where('id', $id)->firstOrFail();
        return view('pages.airlines.taxes.edit', compact('outlet_tax'));
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
            'tax_title' => [
                'required', Rule::unique('outlet_taxes')->where(function ($query) use ($id) {
                    $query->where('outlet_id', session('outlet_id'))
                        ->where('id', '!=', $id);
                })
            ],
            'tax_value' => 'required|numeric',
            'tax_type' => 'required',
            'tax_status' => 'required',
        ]);

        $outlet_tax = OutletTax::where('outlet_id', session('outlet_id'))->where('id', $id)->firstOrFail();

        $outlet_tax->update([
            'tax_title' => $request->tax_title,
            'tax_value' => $request->tax_value,
            'tax_type' => $request->tax_type,
            'tax_status' => $request->tax_status,
            'tax_description' => $request->tax_description,
            'outlet_id' => session('outlet_id'),
            'created_by' => session('employee_id'),
        ]);

        //setting up success message
        if ($outlet_tax) {
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
        return redirect()->route('outlet-taxes.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outlet_tax = OutletTax::where('outlet_id', session('outlet_id'))->where('id', $id)->firstOrFail();
        //setting up success message
        if ($outlet_tax->delete()) {
            $notification = array(
                'message' => 'Tax deleted successfully!',
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
        return redirect()->route('outlet-taxes.index')->with($notification);
    }


    /**
     * Get tax data
     *
     * @param  Request $request
     * @return json
     */
    public function get_tax(Request $request)
    {
        $tax = OutletTax::where('id', $request->id)->where('outlet_id', session('outlet_id'))->select('id', 'tax_title', 'tax_value', 'tax_type')->first();
        return response()->json($tax);
    }
}
