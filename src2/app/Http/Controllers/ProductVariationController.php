<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Variation;
use App\Models\VariationAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductVariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_variations = ProductVariation::leftJoin('products', 'products.id', 'product_variations.product_id')
            ->select('product_variations.*', 'products.product_title')
            ->get();
        // $product_variations = Product::with(['variation_attribute'])
        //     ->where('products.outlet_id', session('outlet_id'))
        //     ->leftJoin('product_variations', 'products.id', '=', 'product_variations.product_id')
        //     ->select(
        //         'products.*',
        //         'product_variations.cost_price',
        //         'product_variations.retail_price',
        //         'product_variations.units_in_stock',
        //         'product_variations.sku',
        //         'product_variations.minimum_threshold',
        //     )
        //     ->groupBy('product_variations.product_id')
        //     ->get();
        // return $product_variations;
        return view('pages.variations.product_variations.product_variations', compact('product_variations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $array1 = [];
        // $array1[] = ["yello", 'Blue'];
        // $array1[] = ["S", " M", " L"];
        // return $array1;

        $products = Product::where('outlet_id', session('outlet_id'))->get();
        $variations = Variation::with('variation_attributes')->where('outlet_id', session('outlet_id'))->select('id', 'variation_title')->get();
        // dd($variations);
        // $variation_attributes = VariationAttribute::where('outlet_id', session('outlet_id'))->pluck('value', 'id');

        return view('pages.variations.product_variations.add_product_variation', compact('variations', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $attr;
        $request->validate([
            'product_id' => 'required',
        ]);


        // $product = Product::where('id', $request->product_id)->first();
        // $variation_attributes = VariationAttribute::whereIn('id', $request->variation_attribute_id)->pluck('id');

        // $product->variation_attribute()->sync($variation_attributes);

        // $query = ProductVariation::where('product_id', $request->product_id)->update([
        //     'cost_price' => $request->cost_price,
        //     'retail_price' => $request->retail_price,
        //     'units_in_stock' => $request->units_in_stock,
        //     'sku' => $request->sku,
        //     'minimum_threshold' =>  $request->minimum_threshold,
        //     'outlet_id' => $request->outlet_id,
        // ]);
        DB::transaction(function () use ($request) {
            for ($i = 0; $i < count($request->variation_combo); $i++) {
                $attr = explode(',', $request->variation_combo[$i]);
                $attr_ids = DB::table('variation_attributes')->whereIn('value', $attr)->pluck('id');
                $attr_ids_string = implode(',', $attr_ids->toArray());
                ProductVariation::create([
                    'product_id' => $request->product_id,
                    'variation_attribute_id' => $attr_ids_string,
                    'cost_price' => $request->cost_price[$i],
                    'retail_price' => $request->retail_price[$i],
                    'stock_keeping' => 1,
                    'units_in_stock' => $request->units_in_stock[$i],
                    'sku' => $request->sku[$i],
                    'minimum_threshold' => $request->minimum_threshold[$i],
                    'outlet_id' => session('outlet_id'),
                    'created_by' => session('employee_id'),
                ]);
            }
        });

        if (DB::transactionLevel() == 0) {
            $notify = array(
                'message' => 'Product Variation added successfully!',
                'alert-type' => 'success'
            );
        }
        //setting up error message
        else {
            $notify = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect('outlets/product-variations')->with($notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductVariation  $productVariation
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVariation $productVariation)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductVariation  $productVariation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $variation_product = Product::with(['variation_attribute'])->where('products.id', $id)
            ->leftJoin('product_variations', 'products.id', '=', 'product_variations.product_id')
            ->select(
                'products.*',
                'product_variations.cost_price',
                'product_variations.retail_price',
                'product_variations.units_in_stock',
                'product_variations.sku',
                'product_variations.minimum_threshold',
            )
            ->first();
        $product_variations = ProductVariation::where('outlet_id', session('outlet_id'))->get();
        // $products = Product::where('outlet_id', session('outlet_id'))->get();
        $variation_attributes = VariationAttribute::where('outlet_id', session('outlet_id'))->pluck('value', 'id');

        return view('pages.variations.product_variations.edit_product_variation', compact('variation_product', 'variation_attributes', 'product_variations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductVariation  $productVariation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'variation_attribute_id' => 'required',
            'retail_price' => 'required|numeric|gte:0',
            'cost_price' => 'required|numeric|gte:0',
            'sku' => 'required|numeric|gte:0',
            'minimum_threshold' => 'required|numeric|gte:0',
            'units_in_stock' => 'required|numeric|gte:0',
        ]);

        $product = Product::where('id', $id)->first();
        $variation_attributes = VariationAttribute::whereIn('id', $request->variation_attribute_id)->pluck('id');

        $product->variation_attribute()->sync($variation_attributes);

        $query = ProductVariation::where('product_id', $id)->update([
            'cost_price' => $request->cost_price,
            'retail_price' => $request->retail_price,
            'units_in_stock' => $request->units_in_stock,
            'sku' => $request->sku,
            'minimum_threshold' =>  $request->minimum_threshold,
            'outlet_id' => $request->outlet_id,
        ]);

        if ($query) {
            $notify = array(
                'message' => 'Product Variation updated successfully!',
                'alert-type' => 'success'
            );
        }
        //setting up error message
        else {
            $notify = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect('product-variations')->with($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVariation  $productVariation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = ProductVariation::where('product_id', $id)->delete();
        if ($query) {
            $notify = array(
                'message' => 'Product Variation deleted successfully!',
                'alert-type' => 'success'
            );
        }
        //setting up error message
        else {
            $notify = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect('product-variations')->with($notify);
    }
}
