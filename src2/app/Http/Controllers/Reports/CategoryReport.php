<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Sales\SalesOrderDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CategoryReport extends Controller
{
    public function filterData(Request $request)
    {
        abort_if(Gate::denies('reports_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('category_report'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $categories = Category::where('outlet_id', session('outlet_id'))->select('id', 'category_title')->get();

        $category_sales_details = SalesOrderDetail::filter()->select(DB::raw('sum(sales_order_details.quantity) as sold_quantity, sum(sales_order_details.amount_payable) as sold_amount, categories.category_title,  categories.id'))
            ->leftJoin('sales_orders', 'sales_order_details.sales_order_id', '=', 'sales_orders.id')
            ->leftJoin('products', 'sales_order_details.product_id', '=', 'products.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where('sales_orders.so_status', 'completed')
            ->groupBy('categories.id')
            ->orderBy('sold_quantity', 'desc')
            ->get();

        $category_purchase_details = InventoryPurchaseOrderDetail::filter()->select(DB::raw('sum(inventory_purchase_order_details.purchased_quantity) as purchased_quantity, sum(inventory_purchase_order_details.item_total) as purchased_amount, categories.category_title,  categories.id'))
            ->leftJoin('inventory_purchase_orders', 'inventory_purchase_order_details.inventory_purchase_order_id', '=', 'inventory_purchase_orders.id')
            ->leftJoin('products', 'inventory_purchase_order_details.product_id', '=', 'products.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where('inventory_purchase_orders.po_status', 'delivered')
            ->groupBy('categories.id')
            ->orderBy('purchased_quantity', 'desc')
            ->get();

        $users = User::select('id', 'username')->get();
        return view('pages.reports.category_report.category_report', compact('categories', 'category_sales_details', 'category_purchase_details', 'users'));
    }
}
