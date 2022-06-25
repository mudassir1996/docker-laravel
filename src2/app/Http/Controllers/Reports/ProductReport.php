<?php

namespace App\Http\Controllers\Reports;

use App\Charts\SalesChart;
use App\Classes\Subscriber;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesOrderDetail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductReport extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filterData(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');

        abort_if(Gate::denies('reports_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('product_report'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $items = Product::where('products.outlet_id', session('outlet_id'))
            ->get();


        $product_total = [];

        foreach ($items as $product) {
            $sold_quantity = 0;
            $total_amount = 0;

            $sales = SalesOrderDetail::filter()
                ->where('sales_order_details.outlet_id', session('outlet_id'))
                ->leftJoin('sales_orders', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
                ->select('sales_order_details.sales_order_id', 'sales_order_details.quantity', 'sales_order_details.product_id', 'sales_order_details.amount_payable as sold_amount')
                ->where('sales_order_details.product_id', $product->id)
                ->get();

            foreach ($sales as $sale) {
                $sold_quantity += $sale->quantity;
                $total_amount += $sale->sold_amount;
            }

            $product_total[] = [
                'product_title' => $product->product_title,
                'sold_quantity' => $sold_quantity,
                'total_amount' => $total_amount,
                'product_id' => $product->id,
                'fromDate' => date('Y-m-d', strtotime(request()->from_date)),
                'toDate' => date('Y-m-d', strtotime(request()->to_date)),
            ];
        }


        if (request()->from_date && request()->to_date != null) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
        } else {
            $fromDate = Carbon::today()->format('Y-m-d');
            $toDate = Carbon::today()->format('Y-m-d');
        }


        return view('pages.reports.product_report.product_report', compact('product_total', 'fromDate', 'toDate'));
    }

    public function product_sales($fromDate, $toDate, $product_id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //return $product_id;
        abort_if(Gate::denies('reports_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('product_report'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $product = Product::where('id', $product_id)->where('outlet_id', session('outlet_id'))->firstOrFail();
        // return $product;
        $product_sales_orders = SalesOrderDetail::where('sales_order_details.product_id', $product_id)
            ->whereDate('sales_order_details.created_at', '>=', $fromDate)
            ->whereDate('sales_order_details.created_at', '<=', $toDate)
            ->select(
                'sales_orders.*',
                'sales_order_details.product_id',
                'sales_order_details.quantity',
                'sales_order_details.created_at',
                'employees.employee_name',
                'customers.customer_name',
                'sales_orders.total_bill',
                'payment_methods.payment_title'
            )

            ->leftJoin('products', 'sales_order_details.product_id', '=', 'products.id')
            ->leftJoin('sales_orders', 'sales_order_details.sales_order_id', '=', 'sales_orders.id')
            ->leftJoin('customers', 'sales_orders.customer_id', '=', 'customers.id')
            ->leftJoin('employees', 'sales_orders.created_by', '=', 'employees.id')
            ->leftJoin('payment_methods', 'sales_orders.payment_method_id', '=', 'payment_methods.id')
            ->orderBy('sales_order_details.created_at', 'desc')
            ->get();


        //return $product_sales_orders;
        return view('pages.reports.product_report.product_sales', compact('product_sales_orders', 'product'));
    }
}
