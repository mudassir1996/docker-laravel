<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\Outlet;
use App\Models\Sales\SalesOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CustomerReport extends Controller
{

    public function filterData(Request $request)
    {
        $verified = Outlet::where('outlets.id', session('outlet_id'))
            ->join('users', 'outlets.created_by', 'users.id')->pluck('verified')->first();
        abort_if(!$verified, Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('reports_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_report'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }


        $most_purchased = SalesOrder::filter()->select(DB::raw('sales_order_details.product_id, products.product_title,sum(sales_order_details.quantity) as total_quantity'))
            ->leftJoin('sales_order_details', 'sales_order_details.sales_order_id', '=', 'sales_orders.id')
            ->leftJoin('products', 'products.id', '=', 'sales_order_details.product_id')
            ->where('sales_orders.so_status', 'completed')
            ->where('sales_orders.payment_type', 'debit')
            ->groupBy('sales_order_details.product_id')
            ->orderByRaw('sum(sales_order_details.quantity) DESC')
            ->take(5)
            ->get();


        // if (request()->from_date && request()->to_date != null) {
        //     $fromDate = $request->from_date;
        //     $toDate = $request->to_date;
        // } else {
        //     $fromDate = Carbon::today()->subDays(7)->format('Y-m-d');
        //     $toDate = Carbon::today()->format('Y-m-d');
        // }

        $sales_orders = SalesOrder::filter()->where('sales_orders.outlet_id', session('outlet_id'))
            ->where('sales_orders.so_status', 'completed')
            ->leftJoin('customers', 'sales_orders.customer_id', '=', 'customers.id')
            ->select('sales_orders.id', 'sales_orders.order_completion_date', 'sales_orders.amount_payable', 'customers.customer_name')
            ->get();

        // dd($sales_orders);

        $avg_buy_amount = SalesOrder::filter()->where('sales_orders.outlet_id', session('outlet_id'))
            ->where('sales_orders.so_status', 'completed')
            ->where('sales_orders.payment_type', 'debit')
            ->avg('amount_payable');


        $avg_buy_quantity = SalesOrder::filter()->where('sales_orders.outlet_id', session('outlet_id'))
            ->leftJoin('sales_order_details', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
            ->where('sales_orders.so_status', 'completed')
            ->where('sales_orders.payment_type', 'debit')
            ->avg('sales_order_details.quantity');

        $debit_amount = CustomerAccount::where('outlet_id', session('outlet_id'))
            ->where('payment_type', 'debit')
            ->where('customer_id', $request->customer_id)
            ->sum('amount');

        $credit_amount = CustomerAccount::where('outlet_id', session('outlet_id'))
            ->where('payment_type', 'credit')
            ->where('customer_id', $request->customer_id)
            ->sum('amount');

        $customer_balance = $debit_amount - $credit_amount;

        $data = [
            'sales_orders' => $sales_orders,
            'customers' => Customer::where('outlet_id', session('outlet_id'))->select('id', 'customer_name')->get(),
            'customer_balance' => $customer_balance,
            'avg_buy_amount' => $avg_buy_amount,
            'avg_buy_quantity' => $avg_buy_quantity,
            'most_purchased' => $most_purchased,
        ];

        return view('pages.reports.customer_report.customer_report')->with($data);
    }
}
