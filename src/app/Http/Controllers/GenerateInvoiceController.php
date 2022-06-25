<?php

namespace App\Http\Controllers;

use App\Models\CustomerAccount;
use App\Models\Sales\SalesOrder;
use Illuminate\Http\Request;

class GenerateInvoiceController extends Controller
{
   public function generate($id, Request $request)
   {
       $sales_order=SalesOrder::where('sales_orders.id', $id)
       ->where('sales_orders.outlet_id', session('outlet_id'))
       ->with('sales_order_detail')
       ->leftJoin('sales_order_details as details', 'sales_orders.id', 'details.sales_order_id')
       ->leftJoin('payment_methods', 'sales_orders.payment_method_id', 'payment_methods.id')
       ->leftJoin('outlets', 'sales_orders.outlet_id', 'outlets.id')
       ->leftJoin('customers', 'sales_orders.customer_id', 'customers.id')
       ->leftJoin('cities', 'outlets.outlet_city', 'cities.id')
       ->select('sales_orders.*',
            'payment_methods.payment_title as payment_method',
            'outlets.outlet_title',
            'outlets.outlet_phone',
            'outlets.outlet_address',
            'cities.city_name',
            'outlets.outlet_feature_img',
            'customers.customer_name',
            'customers.customer_phone',
        )
        ->first();
        
        $customer=CustomerAccount::where('customer_id', $sales_order->customer_id)
        ->where('outlet_id', session('outlet_id'))
        ->orderBy('created_at', 'desc')
        ->select('balance')
        ->first();

        // dd($sales_order);

        return view('pages.invoices.thermal_invoice', compact('sales_order', 'customer', 'request'));
   }
}
