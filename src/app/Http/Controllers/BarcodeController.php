<?php

namespace App\Http\Controllers;

use App\Classes\Subscriber;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BarcodeController extends Controller
{
    public function index()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::where('outlet_id', session('outlet_id'))->get();

        return view('pages.print.barcode.add-product-to-print', compact('products'));
    }

    public function add_print_quantity($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $product = Product::where('products.id', $id)
            ->leftJoin('outlets', 'products.outlet_id', '=', 'outlets.id')
            ->leftJoin('product_stocks', 'products.id', '=', 'product_stocks.product_id')
            ->select('products.*', 'outlets.outlet_title', 'product_stocks.retail_price')
            ->first();
        return view('pages.print.barcode.add-print-quantity', compact('product'));
    }

    public function print_barcode(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $product = Product::find($request->id);

        $print_information = [
            'print_quantity' => $request->quantity,
            'product_price' => $request->product_price,
            'product_title' => $request->product_title,
            'outlet_title' => $request->outlet_title,
        ];

        return view('pages.print.barcode.barcode-export', compact('product', 'print_information'));
    }
    public function generate()
    {
        srand(time());
        return response()->json(['barcode' => rand(10000000, 99999999)]);
    }
}
