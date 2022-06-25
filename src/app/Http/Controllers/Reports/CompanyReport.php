<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Sales\SalesOrderDetail;
use App\Models\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CompanyReport extends Controller
{
   
    public function filterData(Request $request)
    {
        abort_if(Gate::denies('reports_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('company_report'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $companies=Company::where('outlet_id', session('outlet_id'))
        ->select('id', 'company_title')
        ->get();

        $users=User::select('id', 'username')
        ->get();

        // $companies=Company::with(['supplier' => function($q){
        //     $q->select('supplier_title');
        // }])
        // ->where('outlet_id', session('outlet_id'))
        // ->select('id', 'company_title')
        // ->get();

        $company_sales_details = SalesOrderDetail::filter()->select(DB::raw('sum(sales_order_details.quantity) as sold_quantity, sum(sales_order_details.amount_payable) as sold_amount,sales_orders.payment_type ,companies.company_title,  companies.id'))
        ->leftJoin('sales_orders', 'sales_order_details.sales_order_id', '=', 'sales_orders.id')
        ->leftJoin('products', 'sales_order_details.product_id', '=', 'products.id')
        ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
        ->where('sales_orders.so_status', 'completed')
        ->where('sales_order_details.outlet_id',session('outlet_id'))
        ->groupBy('companies.id')
        ->orderBy('sold_quantity', 'desc')
        ->get();


        $company_purchase_details = InventoryPurchaseOrderDetail::filter()->select(DB::raw('sum(inventory_purchase_order_details.purchased_quantity) as purchased_quantity,inventory_purchase_orders.payment_type ,sum(inventory_purchase_order_details.item_total) as purchased_amount, companies.company_title,  companies.id'))
        ->leftJoin('inventory_purchase_orders', 'inventory_purchase_order_details.inventory_purchase_order_id', '=', 'inventory_purchase_orders.id')
        ->leftJoin('products', 'inventory_purchase_order_details.product_id', '=', 'products.id')
        ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
        ->where('inventory_purchase_orders.po_status', 'delivered')
        ->groupBy('companies.id')
        ->orderBy('purchased_amount', 'desc')
        ->get();
        // dd($company_sales_details);

        return view('pages.reports.company_report.company_report', compact('companies', 'company_sales_details', 'company_purchase_details' ,'users'));
       
        
    }
}
