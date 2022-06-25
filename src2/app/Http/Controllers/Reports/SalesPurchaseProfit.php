<?php

namespace App\Http\Controllers\Reports;

use App\Charts\SalesChart;
use App\Http\Controllers\Controller;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SalesPurchaseProfit extends Controller
{
    
    public function index(Request $request){
        abort_if(Gate::denies('reports_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('sales_purchase_profit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        
        $sold_quantity=SalesOrderDetail::where('sales_order_details.outlet_id', session('outlet_id'))
        ->leftJoin('sales_orders', 'sales_order_details.sales_order_id', '=', 'sales_orders.id')
        ->where('sales_orders.so_status', 'completed')
        ->sum('sales_order_details.quantity');
        
        $purchased_quantity=InventoryPurchaseOrderDetail::where('inventory_purchase_order_details.outlet_id', session('outlet_id'))
        ->leftJoin('inventory_purchase_orders', 'inventory_purchase_order_details.inventory_purchase_order_id', '=', 'inventory_purchase_orders.id')
        ->where('inventory_purchase_orders.po_status', 'delivered')
        ->sum('inventory_purchase_order_details.purchased_quantity');      

        $profit=SalesOrder::where('outlet_id', session('outlet_id'))
        ->sum('profit_value');
        
        $sales_total=SalesOrder::where('outlet_id', session('outlet_id'))
        ->where('so_status', 'completed')
        ->sum('amount_payable');
        
        $purchase_total=InventoryPurchaseOrder::where('outlet_id', session('outlet_id'))
        ->where('po_status', 'delivered')
        ->sum('amount_payable');


        $fillColors = [
            "rgb(255, 205, 86)",
            "#dc3545",
            "#28a745",
        ];
       $salesChart=new SalesChart();
        $salesChart->labels(['Total Sales', 'Total Purchases', 'Profit',]);
        $salesChart->dataset('Sales Purchase Profit', 'pie', [$sales_total,  $purchase_total, $profit,])
       ->backgroundcolor($fillColors);

       return view('pages.reports.sp_profit.spp_chart', compact('salesChart', 'sold_quantity', 'purchased_quantity' ,'profit', 'sales_total', 'purchase_total'));
        

    } 
}
