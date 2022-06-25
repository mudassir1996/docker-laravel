<?php

namespace App\Http\Controllers\Reports;

use App\Classes\Subscriber;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Outlet;
use App\Models\Sales\SalesOrder;

use App\Models\Supplier;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PurchaseReport extends Controller
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
            abort_if(Gate::denies('purchase_report'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        if (request()->from_date && request()->to_date != null) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
        } else {
            $fromDate = Carbon::today()->format('Y-m-d');
            $toDate = Carbon::today()->format('Y-m-d');
        }

        $top_purchases = InventoryPurchaseOrder::filter()
            ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->with(['purchase_order_details'])
            ->leftJoin('suppliers', 'suppliers.id', '=', 'inventory_purchase_orders.supplier_id')
            ->select('inventory_purchase_orders.id', 'inventory_purchase_orders.amount_payable', 'suppliers.supplier_title as supplier_name')
            ->groupBy('inventory_purchase_orders.id')
            ->orderByRaw('sum(inventory_purchase_orders.amount_payable) DESC')
            ->take(10)
            ->get();


        $top_products = InventoryPurchaseOrder::filter()->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->join('inventory_purchase_order_details', 'inventory_purchase_order_details.inventory_purchase_order_id', '=', 'inventory_purchase_orders.id')
            ->leftJoin('products', 'products.id', '=', 'inventory_purchase_order_details.product_id')
            ->select(DB::raw('inventory_purchase_orders.id, inventory_purchase_order_details.product_id, products.product_title,sum(inventory_purchase_order_details.purchased_quantity) as total_quantity'))
            ->groupBy('inventory_purchase_order_details.product_id')
            ->orderByRaw('sum(inventory_purchase_order_details.purchased_quantity) DESC')
            ->take(10)
            ->get();

        $top_suppliers = InventoryPurchaseOrder::filter()->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->select(DB::raw('inventory_purchase_orders.supplier_id, suppliers.supplier_title, count(inventory_purchase_orders.supplier_id) as total_purchases, sum(inventory_purchase_orders.amount_payable) as total_amount'))
            ->leftJoin('suppliers', 'suppliers.id', '=', 'inventory_purchase_orders.supplier_id')
            ->groupBy('inventory_purchase_orders.supplier_id')
            ->orderByRaw('sum(inventory_purchase_orders.amount_payable) DESC')
            ->take(5)
            ->get();


        $categories = Category::where('categories.outlet_id', session('outlet_id'))
            ->with(['product'])->get();

        $category_products = [];

        foreach ($categories as $category) {
            $product_quantity = 0;
            $product_amount = 0;
            $total_purchases = 0;

            foreach ($category->product as $product) {

                $purchases = InventoryPurchaseOrder::filter()
                    ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
                    ->join('inventory_purchase_order_details', 'inventory_purchase_order_details.inventory_purchase_order_id', '=', 'inventory_purchase_orders.id')
                    ->where('inventory_purchase_order_details.product_id', $product->id)
                    ->get();

                // return count($sales);

                foreach ($purchases as $purchase) {
                    $product_quantity += $purchase->purchased_quantity;
                    $product_amount += $purchase->amount_payable;
                }
                $total_purchases += count($purchases);
            }
            $category_products[] = [
                'category_name' => $category->category_title,
                'product_quantity' => $product_quantity,
                'product_amount' => $product_amount,
                'total_purchases' => $total_purchases

            ];
        }
        $top_categories = collect($category_products)->sortBy('product_amount')->reverse()->toArray();



        $companies = Company::where('companies.outlet_id', session('outlet_id'))
            ->with(['product'])->get();

        $company_products = [];

        foreach ($companies as $company) {
            $product_quantity = 0;
            $product_amount = 0;
            $total_purchases = 0;

            foreach ($company->product as $product) {

                $purchases = InventoryPurchaseOrder::filter()
                    ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
                    ->join('inventory_purchase_order_details', 'inventory_purchase_order_details.inventory_purchase_order_id', '=', 'inventory_purchase_orders.id')
                    ->where('inventory_purchase_order_details.product_id', $product->id)
                    ->get();

                // return count($sales);

                foreach ($purchases as $purchase) {
                    $product_quantity += $purchase->purchased_quantity;
                    $product_amount += $purchase->amount_payable;
                }
                $total_purchases += count($purchases);
            }
            $company_products[] = [
                'company_name' => $company->company_title,
                'product_quantity' => $product_quantity,
                'product_amount' => $product_amount,
                'total_purchases' => $total_purchases

            ];
        }
        $top_companies = collect($company_products)->sortBy('product_quantity')->reverse()->toArray();








        return view('pages.reports.puchase_report.report', compact('top_purchases', 'top_products', 'top_suppliers', 'top_categories', 'top_companies', 'fromDate', 'toDate'));
    }
}
