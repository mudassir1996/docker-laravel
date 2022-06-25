<?php

namespace App\Http\Controllers\Reports;

use App\Charts\SalesChart;
use App\Classes\Subscriber;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Outlet;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesOrderDetail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SalesReport extends Controller
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
            abort_if(Gate::denies('sales_report'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $sales = SalesOrder::filter()->select('id', 'created_at')
            ->where('outlet_id', session('outlet_id'))
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('d'); // grouping by months
            });



        $top_sales = SalesOrder::where('sales_orders.outlet_id', session('outlet_id'))->filter()
            ->with(['sales_order_detail'])
            // ->leftJoin('sales_order_details', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
            ->leftJoin('customers', 'customers.id', '=', 'sales_orders.customer_id')
            ->select('sales_orders.id', 'sales_orders.amount_payable', 'customers.customer_name')
            ->groupBy('sales_orders.id')
            ->orderByRaw('sum(sales_orders.amount_payable) DESC')
            ->take(10)
            ->get();
        // return $top_sales;

        // $test = SalesOrderDetail::leftJoin('sales_orders', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
        //     ->groupBy('sales_orders.id')
        //     ->orderByRaw('sum(sales_orders.amount_payable) DESC')
        //     ->take(10)->get();
        // return $test;

        $top_products = SalesOrder::filter()->where('sales_orders.outlet_id', session('outlet_id'))
            ->join('sales_order_details', 'sales_order_details.sales_order_id', '=', 'sales_orders.id')
            ->leftJoin('products', 'products.id', '=', 'sales_order_details.product_id')
            ->select(DB::raw('sales_orders.id, sales_order_details.product_id, products.product_title,sum(sales_order_details.quantity) as total_quantity'))
            ->groupBy('sales_order_details.product_id')
            ->orderByRaw('sum(sales_order_details.quantity) DESC')
            ->take(10)
            ->get();

        $top_customers = SalesOrder::filter()->where('sales_orders.outlet_id', session('outlet_id'))
            ->select(DB::raw('sales_orders.customer_id, customers.customer_name, sum(sales_orders.amount_payable) as total_sales'))
            ->leftJoin('customers', 'customers.id', '=', 'sales_orders.customer_id')
            ->groupBy('sales_orders.customer_id')
            ->orderByRaw('sum(sales_orders.amount_payable) DESC')
            ->take(5)
            ->get();

        $categories = Category::where('categories.outlet_id', session('outlet_id'))
            ->with(['product'])->get();

        $category_products = [];

        foreach ($categories as $category) {
            $product_quantity = 0;
            $product_amount = 0;
            $total_sales = 0;

            foreach ($category->product as $product) {

                $sales = SalesOrder::filter()
                    ->where('sales_order_details.outlet_id', session('outlet_id'))
                    ->join('sales_order_details', 'sales_order_details.sales_order_id', '=', 'sales_orders.id')
                    ->where('sales_order_details.product_id', $product->id)
                    ->get();


                foreach ($sales as $sale) {
                    $product_quantity += $sale->quantity;
                    $product_amount += $sale->amount_payable;
                }
                $total_sales += count($sales);
            }
            $category_products[] = [
                'category_name' => $category->category_title,
                'product_quantity' => $product_quantity,
                'product_amount' => $product_amount,
                'total_sales' => $total_sales

            ];
        }
        $top_categories = collect($category_products)->sortBy('product_amount')->reverse()->toArray();
        // return $top_categories;
        if (request()->from_date && request()->to_date != null) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
        } else {
            $fromDate = Carbon::today()->subDays(7)->format('Y-m-d');
            $toDate = Carbon::today()->format('Y-m-d');
        }


        return view('pages.reports.sales_report.sales_chart', compact('top_categories',  'top_customers', 'top_sales', 'top_products', 'fromDate', 'toDate'));
    }
}
