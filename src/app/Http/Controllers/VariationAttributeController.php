<?php

namespace App\Http\Controllers;

use App\Models\Variation;
use App\Models\VariationAttribute;
use Illuminate\Http\Request;

class VariationAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variation_attributes = VariationAttribute::where('variation_attributes.outlet_id', session('outlet_id'))
            ->leftJoin('variations', 'variation_attributes.variation_id', 'variations.id')
            ->select('variation_attributes.*', 'variations.variation_title')
            ->get();

        return view('pages.variations.variation_attributes.variation_attributes', compact('variation_attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $variations = Variation::where('outlet_id', session('outlet_id'))->get();

        return view('pages.variations.variation_attributes.add_variation_attribute', compact('variations'));
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
            'variation_id' => 'required',
            'value' => 'required',
        ]);
        // return $request;
        $values = explode(',', implode(', ', array_column(json_decode($request->value), 'value')));
        // return $values;
        foreach ($values as $value) {
            $variation_attribute = new VariationAttribute;

            $variation_attribute->variation_id = $request->variation_id;
            //    $variation_attribute->value = implode(', ', array_column(json_decode($request->value), 'value'));
            $variation_attribute->value = $value;
            $variation_attribute->outlet_id = $request->outlet_id;
            $query = $variation_attribute->save();
        }

        if ($query) {
            //setting up success message
            $notification = array(
                'message' => 'Variation Attributes has been added!',
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
        return redirect('variation-attributes')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VariationAttribute  $variationAttribute
     * @return \Illuminate\Http\Response
     */
    public function show(VariationAttribute $variationAttribute)
    {
        //
    }

    public function get_attributes(Request $request)
    {
        $variation_attributes = VariationAttribute::where('variation_id', $request->variation_id)->pluck('value', 'id');

        return response()->json($variation_attributes);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VariationAttribute  $variationAttribute
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $variation_attribute = VariationAttribute::find($id);
        $variations = Variation::where('outlet_id', session('outlet_id'))->get();

        return view('pages.variations.variation_attributes.edit_variation_attribute', compact('variations', 'variation_attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VariationAttribute  $variationAttribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'variation_id' => 'required',
            'value' => 'required',
        ]);
        // return $request;
        $values = explode(',', implode(', ', array_column(json_decode($request->value), 'value')));
        // return $values;
        foreach ($values as $value) {
            $variation_attribute = VariationAttribute::find($id);

            $variation_attribute->variation_id = $request->variation_id;
            //    $variation_attribute->value = implode(', ', array_column(json_decode($request->value), 'value'));
            $variation_attribute->value = $value;
            $variation_attribute->outlet_id = $request->outlet_id;
            $query = $variation_attribute->update();
        }

        if ($query) {
            //setting up success message
            $notification = array(
                'message' => 'Variation Attributes has been added!',
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
        return redirect('variation-attributes')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VariationAttribute  $variationAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (VariationAttribute::find($id)->delete()) {
            //setting up success message
            $notification = array(
                'message' => 'Variation Attribute has been updated!',
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
        return redirect('variation-attributes')->with($notification);
    }
}
