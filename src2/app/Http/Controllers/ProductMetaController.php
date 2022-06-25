<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_metas = ProductMeta::where('product_metas.outlet_id', session('outlet_id'))
            ->leftJoin('custom_fields', 'product_metas.custom_field_id', '=', 'custom_fields.id')
            ->leftJoin('products', 'product_metas.product_id', '=', 'products.id')
            ->select('product_metas.*', 'custom_fields.title as custom_field_title', 'products.product_title')
            ->get();

        return view('pages.product.product_meta.product_metas', compact('product_metas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $custom_fields = DB::table('custom_fields')->get();
        $products = Product::where('outlet_id', session('outlet_id'))->get();

        return view('pages.product_meta.add_product_meta', compact('custom_fields', 'products'));
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
            'product_id' => 'required',
            'custom_field_id' => 'required',
            'value' => 'required',
        ]);

        $product_meta = new ProductMeta;

        $product_meta->product_id = $request->product_id;
        $product_meta->custom_field_id = $request->custom_field_id;
        $product_meta->value = $request->value;
        $product_meta->outlet_id = $request->outlet_id;

        if ($product_meta->save()) {
            //setting up success message
            $notification = array(
                'message' => 'Product Meta has been added!',
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
        return redirect('product-metas')->with($notification);
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
        $product_meta = ProductMeta::find($id);
        $custom_fields = DB::table('custom_fields')->get();
        $products = Product::where('outlet_id', session('outlet_id'))->get();

        return view('pages.product.product_meta.edit_product_meta', compact('product_meta', 'custom_fields', 'products'));
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
            'product_id' => 'required',
            'custom_field_id' => 'required',
            'value' => 'required',
        ]);

        $product_meta = ProductMeta::find($id);

        $product_meta->product_id = $request->product_id;
        $product_meta->custom_field_id = $request->custom_field_id;
        $product_meta->value = $request->value;
        $product_meta->outlet_id = $request->outlet_id;

        if ($product_meta->update()) {
            //setting up success message
            $notification = array(
                'message' => 'Product Meta has been updated!',
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
        return redirect('product-metas')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_meta = ProductMeta::find($id);

        if ($product_meta->delete()) {
            //setting up success message
            $notification = array(
                'message' => 'Product Meta has been deleted!',
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
        return redirect('product-metas')->with($notification);
    }
}
