<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Product;
use App\Models\ProductPurchases;
use App\Models\ProductStock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductPurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        $purchases = ProductPurchases::where('outlet_id', session('outlet_id'))->get();
        return view('pages.product.purchases', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::where('outlet_id', session('outlet_id'))->pluck('supplier_title', 'id');
        $products = Product::where('outlet_id', session('outlet_id'))->pluck('product_title', 'id');
        $payment_methods = DB::table('payment_methods')->pluck('payment_title', 'id');
        return view('pages.product.add_purchase', compact('suppliers', 'payment_methods', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $purchase = new ProductPurchases($request->all());
        $units = ProductStock::where('product_id', $request->product_id)->pluck('units_in_stock')->first();

        ProductStock::where('product_id', $request->product_id)->update([
            'cost_price' => $request->cost_price,
            'retail_price' => $request->retail_price,
            'units_in_stock' => $units + $request->quantity
        ]);
        if ($purchase->save()) {
            //setting up success message
            $notification = array(
                'message' => 'Product purchase added successfully!',
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
        return redirect('outlets/purchases')->with($notification);
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
        $suppliers = Supplier::where('outlet_id', session('outlet_id'))->pluck('supplier_title', 'id');
        $products = Product::where('outlet_id', session('outlet_id'))->pluck('product_title', 'id');
        $payment_methods = DB::table('payment_methods')->pluck('payment_title', 'id');
        $purchase = ProductPurchases::find($id);
        return view('pages.product.edit_purchase', compact('suppliers', 'products', 'payment_methods', 'purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductPurchases $purchase)
    {


        ProductStock::where('product_id', $request->product_id)->update([
            'cost_price' => $request->cost_price,
            'retail_price' => $request->retail_price,
        ]);

        if ($purchase->update($request->all())) {
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
        return redirect('outlets/purchases')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = ProductPurchases::find($id);
        //setting up success message
        if ($purchase->delete()) {
            $notification = array(
                'message' => 'Purchase deleted successfully!',
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
        return redirect('outlets/purchases')->with($notification);
    }
}
