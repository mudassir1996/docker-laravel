<?php

namespace App\Http\Controllers\Reports;

use App\Charts\SalesChart;
use App\Classes\Subscriber;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\ExpenseTransaction;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Outlet;
use App\Models\PaymentType;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesOrderDetail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DailySummary extends Controller
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
        // dd(request()->from_date);

        // $payment_types = PaymentType::where('outlet_id', session('outlet_id'))->get();
        // $payment_types->where('value',0)->first

        // $sales = SalesOrder::filter()->select('id', 'created_at')
        //     ->where('outlet_id', session('outlet_id'))
        //     ->get()
        //     ->groupBy(function ($date) {
        //         return Carbon::parse($date->created_at)->format('d'); // grouping by months
        //     });



        // $top_products = SalesOrderDetail::select(DB::raw('sales_order_details.product_id, products.product_title,sum(sales_order_details.quantity)'))
        //     ->leftJoin('products', 'products.id', '=', 'sales_order_details.product_id')
        //     ->groupBy('sales_order_details.product_id')
        //     ->orderByRaw('sum(sales_order_details.quantity) DESC')
        //     ->take(5)
        //     ->get();


        // $total_sales = SalesOrder::filter()->select('id', 'created_at')
        //     ->where('outlet_id', session('outlet_id'))
        //     ->sum('amount_payable');



        // $total_profit = SalesOrder::filter()
        //     ->where('outlet_id', session('outlet_id'))
        //     ->sum('profit_value');


        // $IncashSales = SalesOrder::filter()->select('sales_orders.id', 'sales_orders.customer_id', 'sales_orders.customer_id', 'sales_orders.order_completion_date', 'sales_orders.so_status', 'sales_orders.amount_payable', 'customers.customer_name',)
        //     ->leftJoin('customers', 'sales_orders.customer_id', '=', 'customers.id')
        //     ->where('sales_orders.outlet_id', session('outlet_id'))
        //     ->where('sales_orders.payment_type', 'cash')
        //     ->orderBy('sales_orders.id', 'desc')
        //     ->get();

        // $InsplitBillSales = SalesOrder::filter()->select('sales_orders.id', 'sales_orders.order_completion_date', 'sales_orders.so_status', 'sales_orders.amount_paid')
        //     ->where('sales_orders.outlet_id', session('outlet_id'))
        //     ->where('sales_orders.payment_type', 'split_bill')
        //     ->orderBy('sales_orders.id', 'desc')
        //     ->get();

        // $IncustomerSales = CustomerAccount::filter()
        //     ->where('customer_accounts.outlet_id', session('outlet_id'))
        //     ->where('customer_accounts.payment_type', 'debit')
        //     ->orderBy('customer_accounts.id', 'desc')
        //     ->select('amount')
        //     ->get();

        // // dd($IncustomerSales);

        // $OutcustomerSales = CustomerAccount::filter()
        //     ->where('customer_accounts.outlet_id', session('outlet_id'))
        //     ->where('customer_accounts.payment_type', 'credit')
        //     ->orderBy('customer_accounts.id', 'desc')
        //     ->select('amount')
        //     ->get();


        // $outGoingSales = SalesOrder::filter()->select('sales_orders.id', 'sales_orders.customer_id', 'sales_orders.customer_id', 'sales_orders.order_completion_date', 'sales_orders.so_status', 'sales_orders.amount_payable', 'customers.customer_name',)
        //     ->leftJoin('customers', 'sales_orders.customer_id', '=', 'customers.id')
        //     ->where('sales_orders.outlet_id', session('outlet_id'))
        //     ->where('sales_orders.payment_type', 'credit')
        //     ->orderBy('sales_orders.id', 'desc')
        //     ->get();

        // $OutcreditSales = SalesOrder::filter()->select('sales_orders.id', 'sales_orders.customer_id', 'sales_orders.customer_id', 'sales_orders.order_completion_date', 'sales_orders.so_status', 'sales_orders.amount_payable', 'customers.customer_name',)
        //     ->leftJoin('customers', 'sales_orders.customer_id', '=', 'customers.id')
        //     ->where('sales_orders.outlet_id', session('outlet_id'))
        //     ->where('sales_orders.payment_type', 'credit')
        //     ->orderBy('sales_orders.id', 'desc')
        //     ->get();

        // $OutsplitBillSales = SalesOrder::filter()->select('sales_orders.id', 'sales_orders.order_completion_date', 'sales_orders.so_status', 'sales_orders.change_back')
        //     // ->leftJoin('customers', 'sales_orders.customer_id', '=', 'customers.id')
        //     ->where('sales_orders.outlet_id', session('outlet_id'))
        //     ->where('sales_orders.payment_type', 'split_bill')
        //     ->orderBy('sales_orders.id', 'desc')
        //     ->get();

        // // $expenses = ExpenseTransaction::test()
        // //     ->where('outlet_id', session('outlet_id'))
        // //     ->orderBy('id', 'desc')
        // //     ->toSql();

        // // return $expenses;
        // $expenses = ExpenseTransaction::filter()
        //     ->where('outlet_id', session('outlet_id'))
        //     ->orderBy('id', 'desc')
        //     ->get();

        // // $purchaseOrders = InventoryPurchaseOrder::filter()
        // // ->where('outlet_id', session('outlet_id'))
        // // ->orderBy('id', 'desc')
        // // ->get();

        // $purchaseOrders = InventoryPurchaseOrder::filter()
        //     ->where('outlet_id', session('outlet_id'))
        //     ->where('po_status', 'delivered')
        //     ->orderBy('id', 'desc')
        //     ->get();


        // $customers = Customer::select('id', 'customer_name')
        //     ->where('outlet_id', session('outlet_id'))
        //     ->get();

        // $users = User::select('id', 'username')
        //     ->get();

        $total_products_quantity = 0;
        $avgOrderQuantity = 0;
        $avgOrderBill = 0;
        $totalOrderDiscount = 0;
        $totalProductDiscount = 0;
        $totalDiscount = 0;
        $totalProfit = 0;
        $totalExpenses = 0;
        $totalIncome = 0;


        $grandTotal = SalesOrder::filter()
            ->where('outlet_id', session('outlet_id'))
            ->where('so_status', 'completed')
            ->pluck('total_bill')->sum();

        $payableBill = SalesOrder::filter()
            ->where('outlet_id', session('outlet_id'))
            ->where('so_status', 'completed')
            ->pluck('amount_payable')->sum();

        $salesOrders = SalesOrder::with(['sales_order_detail'])->filter()
            ->where('outlet_id', session('outlet_id'))
            ->where('so_status', 'completed')
            ->get();

        $totalExpenses = ExpenseTransaction::filter()
            ->where('outlet_id', session('outlet_id'))
            ->pluck('amount')->sum();






        foreach ($salesOrders as $salesOrder) {
            foreach ($salesOrder->sales_order_detail as $order_detail) {
                $total_products_quantity += $order_detail->quantity;
                $totalProductDiscount += $order_detail->discount_value;
            }
            $totalOrderDiscount += $salesOrder->so_discount_value;
            $totalProfit += $salesOrder->profit_value;
        }

        if (count($salesOrders) > 0) {
            $avgOrderQuantity = $total_products_quantity / count($salesOrders);
            $avgOrderBill = $payableBill / count($salesOrders);
        }

        $totalDiscount = $totalOrderDiscount + $totalProductDiscount;

        $totalIncome = $totalProfit - $totalExpenses;



        if (!empty(request()->from_date) && !empty(request()->to_date)) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
        } else {
            $fromDate = Carbon::today()->format('Y-m-d');
            $toDate = Carbon::today()->format('Y-m-d');
        }




        // return view('pages.reports.daily_summary', compact('purchaseOrders', 'expenses', 'total_sales', 'total_profit', 'customers', 'users', 'IncashSales', 'InsplitBillSales', 'IncustomerSales', 'OutcreditSales', 'OutsplitBillSales', 'OutcustomerSales', 'top_products', 'fromDate', 'toDate'));
        return view('pages.reports.daily_summary', compact(
            'avgOrderBill',
            'grandTotal',
            'avgOrderQuantity',
            'totalDiscount',
            'payableBill',
            'totalProfit',
            'totalExpenses',
            'totalIncome',
            'fromDate',
            'toDate'
        ));
    }
}
