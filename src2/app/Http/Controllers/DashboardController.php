<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ExpenseTransaction;
use App\Models\Outlet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dashboard_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('dashboard_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        // dd(config('custom-config.outlet_id'));
        $page_title = 'Dashboard';

        $page_description = 'Some description for the page';
        $sales = DB::table('sales_orders')
            ->whereDate('created_at', '>=', Carbon::today()->subDays(7))
            ->whereDate('created_at', '<=', Carbon::today())
            // ->whereBetween('created_at', [Carbon::today()->subDays(7)->format('Y-m-d H:i:s'), Carbon::today()->format('Y-m-d H:i:s')])
            ->where('outlet_id', session('outlet_id'))
            ->sum('amount_payable');

        // dd($sales);

        $no_of_sales = DB::table('sales_orders')
            ->whereDate('created_at', '>=', Carbon::today()->subDays(7))
            ->whereDate('created_at', '<=', Carbon::today())
            ->where('outlet_id', session('outlet_id'))
            ->count('id');

        $profit = DB::table('sales_orders')
            ->whereDate('created_at', '>=', Carbon::today()->subDays(7))
            ->whereDate('created_at', '<=', Carbon::today())
            ->where('outlet_id', session('outlet_id'))
            ->sum('profit_value');

        $discount = DB::table('sales_orders')
            ->whereDate('created_at', '>=', Carbon::today()->subDays(7))
            ->whereDate('created_at', '<=', Carbon::today())
            ->where('outlet_id', session('outlet_id'))
            ->sum('so_discount_value');

        $new_products = DB::table('products')->where('outlet_id', session('outlet_id'))
            ->whereDate('created_at', '=', Carbon::today())
            ->get();

        $sales_orders = DB::table('sales_orders')
            ->leftJoin('payment_types', 'sales_orders.payment_type', 'payment_types.id')
            ->selectRaw("count(sales_orders.id) as completed")
            ->selectRaw("sum(case when sales_orders.so_status = 'completed' then sales_orders.profit_value end) as total_profit")
            ->selectRaw("count(case when sales_orders.so_status = 'on-hold' then 1 end) as on_hold")
            ->selectRaw("count(case when payment_types.value = 1 then 1 end) as credit")
            ->selectRaw("count(case when payment_types.value = 0 and sales_orders.so_status = 'completed'  then 1 end) as debit")
            ->selectRaw("count(case when payment_types.value = 2 then 1 end) as split_bill")
            ->selectRaw("sum(sales_orders.amount_payable) as completed_amount")
            ->selectRaw("sum(case when sales_orders.so_status = 'on-hold' then sales_orders.amount_payable end) as hold_amount")
            ->selectRaw("sum(case when payment_types.value = 1 then sales_orders.amount_payable end) as credit_amount")
            ->selectRaw("sum(case when payment_types.value = 0 and sales_orders.so_status = 'completed' then amount_payable end) as debit_amount")
            ->selectRaw("sum(case when payment_types.value = 2 and sales_orders.change_back < 0 then sales_orders.amount_paid when payment_types.value = 2 and sales_orders.change_back > 0 then sales_orders.amount_payable end) as split_paid_amount")
            ->selectRaw("sum(case when payment_types.value = 2 and sales_orders.change_back < 0 then sales_orders.change_back end) as split_remain_amount")
            ->where('sales_orders.outlet_id', session('outlet_id'))
            ->whereDate('sales_orders.created_at', '=', Carbon::today())
            ->first();

        // dd($sales_orders);

        $purchase_orders = DB::table('inventory_purchase_orders')
            ->selectRaw("count(case when po_status = 'requested' then 1 end) as requested")
            ->selectRaw("count(case when po_status = 'in-process' then 1 end) as in_process")
            ->selectRaw("count(case when po_status = 'shipped' then 1 end) as shipped")
            ->selectRaw("count(case when po_status = 'delivered' then 1 end) as delivered")
            ->selectRaw("sum(case when po_status = 'requested' then amount_payable end) as requested_amount")
            ->selectRaw("sum(case when po_status = 'in-process' then amount_payable end) as in_process_amount")
            ->selectRaw("sum(case when po_status = 'shipped' then amount_payable end) as shipped_amount")
            ->selectRaw("sum(case when po_status = 'delivered' then amount_payable end) as delivered_amount")
            ->where('outlet_id', session('outlet_id'))
            ->whereDate('created_at', '=', Carbon::today())
            ->first();

        $expense = ExpenseTransaction::where('outlet_id', session('outlet_id'))
            ->selectRaw('sum(amount) as amount')
            ->whereDate('created_at', '=', Carbon::today())
            ->first();

        $expense = $expense->amount;

        $new_customers = Customer::where('outlet_id', session('outlet_id'))
            ->whereDate('created_at', '=', Carbon::today())
            ->count('id');
        // dd($new_customers);

        return view(
            'pages.dashboard',
            compact(
                'page_title',
                'page_description',
                'no_of_sales',
                'sales',
                'profit',
                'discount',
                'new_products',
                'sales_orders',
                'purchase_orders',
                'expense',
                'new_customers'

            )
        );
    }

    public function summary(Request $request)
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'outlets.outlet_city', 'cities.id')
            ->select('outlet_title', 'outlet_address', 'outlet_phone', 'outlet_feature_img', 'cities.city_name')->first();
        // dd($request->all());
        $page_title = "Summary";
        $new_products = DB::table('products')->where('outlet_id', session('outlet_id'))
            ->whereDate('created_at', '=', Carbon::today())
            ->get();

        $sales_orders = DB::table('sales_orders')
            ->leftJoin('payment_types', 'sales_orders.payment_type', 'payment_types.id')
            ->selectRaw("count(sales_orders.id) as completed")
            ->selectRaw("sum(case when sales_orders.so_status = 'completed' then sales_orders.profit_value end) as total_profit")
            ->selectRaw("count(case when sales_orders.so_status = 'on-hold' then 1 end) as on_hold")
            ->selectRaw("count(case when payment_types.value = 1 then 1 end) as credit")
            ->selectRaw("count(case when payment_types.value = 0 and sales_orders.so_status = 'completed'  then 1 end) as debit")
            ->selectRaw("count(case when payment_types.value = 2 then 1 end) as split_bill")
            ->selectRaw("sum(sales_orders.amount_payable) as completed_amount")
            ->selectRaw("sum(case when sales_orders.so_status = 'on-hold' then sales_orders.amount_payable end) as hold_amount")
            ->selectRaw("sum(case when payment_types.value = 1 then sales_orders.amount_payable end) as credit_amount")
            ->selectRaw("sum(case when payment_types.value = 0 and sales_orders.so_status = 'completed' then amount_payable end) as debit_amount")
            ->selectRaw("sum(case when payment_types.value = 2 and sales_orders.change_back < 0 then sales_orders.amount_paid when payment_types.value = 2 and sales_orders.change_back > 0 then sales_orders.amount_payable end) as split_paid_amount")
            ->selectRaw("sum(case when payment_types.value = 2 and sales_orders.change_back < 0 then sales_orders.change_back end) as split_remain_amount")
            ->where('sales_orders.outlet_id', session('outlet_id'))
            ->whereDate('sales_orders.created_at', '=', Carbon::today())
            ->first();

        // dd($sales_orders);

        $purchase_orders = DB::table('inventory_purchase_orders')
            ->selectRaw("count(case when po_status = 'requested' then 1 end) as requested")
            ->selectRaw("count(case when po_status = 'in-process' then 1 end) as in_process")
            ->selectRaw("count(case when po_status = 'shipped' then 1 end) as shipped")
            ->selectRaw("count(case when po_status = 'delivered' then 1 end) as delivered")
            ->selectRaw("sum(case when po_status = 'requested' then amount_payable end) as requested_amount")
            ->selectRaw("sum(case when po_status = 'in-process' then amount_payable end) as in_process_amount")
            ->selectRaw("sum(case when po_status = 'shipped' then amount_payable end) as shipped_amount")
            ->selectRaw("sum(case when po_status = 'delivered' then amount_payable end) as delivered_amount")
            ->where('outlet_id', session('outlet_id'))
            ->whereDate('created_at', '=', Carbon::today())
            ->first();


        $expense = ExpenseTransaction::where('outlet_id', session('outlet_id'))
            ->selectRaw('sum(amount) as amount')
            ->whereDate('created_at', '=', Carbon::today())
            ->first();

        $expense = $expense->amount;

        $new_customers = Customer::where('outlet_id', session('outlet_id'))
            ->whereDate('created_at', '=', Carbon::today())
            ->count('id');

        // dd($debit_sales_orders);

        return view(
            'pages.widgets._widget-print',
            compact(
                'outlet',
                'request',
                'page_title',
                'new_products',
                'sales_orders',
                'purchase_orders',
                'expense',
                'new_customers'
            )
        );
    }

    /**
     * Demo methods below
     */

    // Datatables
    public function datatables()
    {

        $page_title = 'Datatables';
        $page_description = 'This is datatables test page';

        return view('pages.datatables', compact('page_title', 'page_description'));
    }

    // KTDatatables
    public function ktDatatables()
    {
        $page_title = 'KTDatatables';
        $page_description = 'This is KTdatatables test page';

        return view('pages.ktdatatables', compact('page_title', 'page_description'));
    }

    // Select2
    public function select2()
    {
        $page_title = 'Select 2';
        $page_description = 'This is Select2 test page';

        return view('pages.select2', compact('page_title', 'page_description'));
    }

    // custom-icons
    public function customIcons()
    {
        $page_title = 'customIcons';
        $page_description = 'This is customIcons test page';

        return view('pages.icons.custom-icons', compact('page_title', 'page_description'));
    }

    // flaticon
    public function flaticon()
    {
        $page_title = 'flaticon';
        $page_description = 'This is flaticon test page';

        return view('pages.icons.flaticon', compact('page_title', 'page_description'));
    }

    // fontawesome
    public function fontawesome()
    {
        $page_title = 'fontawesome';
        $page_description = 'This is fontawesome test page';

        return view('pages.icons.fontawesome', compact('page_title', 'page_description'));
    }

    // lineawesome
    public function lineawesome()
    {
        $page_title = 'lineawesome';
        $page_description = 'This is lineawesome test page';

        return view('pages.icons.lineawesome', compact('page_title', 'page_description'));
    }

    // socicons
    public function socicons()
    {
        $page_title = 'socicons';
        $page_description = 'This is socicons test page';

        return view('pages.icons.socicons', compact('page_title', 'page_description'));
    }

    // svg
    public function svg()
    {
        $page_title = 'svg';
        $page_description = 'This is svg test page';

        return view('pages.icons.svg', compact('page_title', 'page_description'));
    }

    // Quicksearch Result
    public function quickSearch()
    {
        return view('layout.partials.extras._quick_search_result');
    }
}
