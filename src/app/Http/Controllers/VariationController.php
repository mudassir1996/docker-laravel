<?php

namespace App\Http\Controllers;

use App\Models\Variation;
use App\Models\VariationAttribute;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('variation_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $variations = Variation::with('variation_attributes')->where('variations.outlet_id', session('outlet_id'))
            ->leftJoin('employees', 'variations.created_by', 'employees.id')
            ->select('variations.*', 'employees.employee_name')
            ->get();

        return view('pages.variations.variations', compact('variations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('variation_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('pages.variations.add_variation');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('variation_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'variation_title' => 'required',
            'value' => 'required',
            'status' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $variation = new Variation;
            $variation->variation_title = $request->variation_title;
            $variation->status = $request->status;
            $variation->outlet_id = $request->outlet_id;
            $variation->created_by = session('employee_id');
            $variation->save();

            $values = explode(',', implode(',', array_column(json_decode($request->value), 'value')));
            foreach ($values as $value) {
                $variation_attribute = new VariationAttribute();
                $variation_attribute->variation_id = $variation->id;
                $variation_attribute->value = $value;
                $variation_attribute->outlet_id = $request->outlet_id;
                $variation_attribute->save();
            }
        });

        if (DB::transactionLevel() == 0) {
            //setting up success message
            $notification = array(
                'message' => 'Variation has been added!',
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
        return redirect('outlets/variations')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function show(Variation $variation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('variation_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $variation = Variation::with('variation_attributes')->where('outlet_id', session('outlet_id'))->findOrFail($id);
        return view('pages.variations.edit_variation', compact('variation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('variation_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'variation_title' => 'required',
            'status' => 'required',
        ]);

        DB::transaction(function () use ($id, $request) {
            $variation = Variation::find($id);

            $variation->variation_title = $request->variation_title;
            $variation->status = $request->status;
            $variation->outlet_id = $request->outlet_id;
            $variation->created_by = session('employee_id');
            $variation->save();

            VariationAttribute::where('variation_id', $variation->id)->delete();

            $values = explode(',', implode(', ', array_column(json_decode($request->value), 'value')));
            foreach ($values as $value) {
                $variation_attribute = new VariationAttribute();
                $variation_attribute->variation_id = $variation->id;
                $variation_attribute->value = $value;
                $variation_attribute->outlet_id = $request->outlet_id;
                $variation_attribute->save();
            }
        });

        if (DB::transactionLevel() == 0) {
            //setting up success message
            $notification = array(
                'message' => 'Variation has been updated!',
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
        return redirect('outlets/variations')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('variation_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        DB::transaction(function () use ($id) {
            Variation::findOrFail($id)->delete();
            VariationAttribute::where('variation_id', $id)->delete();
        });

        if (DB::transactionLevel() == 0) {
            //setting up success message
            $notification = array(
                'message' => 'Variation has been deleted!',
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
        return redirect('outlets/variations')->with($notification);
    }
}
