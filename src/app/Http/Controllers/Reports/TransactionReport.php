<?php

namespace App\Http\Controllers\Reports;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Sales\SalesOrder;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TransactionReport extends Controller
{
    
    public function filterData(Request $request){
        abort_if(Gate::denies('reports_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('transaction_report'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        if (request()->from_date && request()->to_date != null) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
        } else {
            $fromDate = Carbon::today()->subDays(7)->format('Y-m-d');
            $toDate = Carbon::today()->format('Y-m-d');
        }
        $customers=Customer::where('outlet_id', session('outlet_id'))
            ->select('id', 'customer_name')
            ->get();
        
        $suppliers=Supplier::where('outlet_id', session('outlet_id'))
            ->select('id', 'supplier_title')
            ->get();


        $sales_transactions = SalesOrder::filter()->where('sales_orders.outlet_id', session('outlet_id'))
            ->where('sales_orders.so_status', 'completed')
            ->leftJoin('customers', 'sales_orders.customer_id', '=', 'customers.id')
            ->select('sales_orders.id', 'sales_orders.order_completion_date', 'sales_orders.amount_payable','sales_orders.payment_type' ,'customers.customer_name')
            ->get();
        
        $purchase_transactions = InventoryPurchaseOrder::filter()->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->where('inventory_purchase_orders.po_status', 'delivered')
            ->leftJoin('suppliers', 'inventory_purchase_orders.supplier_id', '=', 'suppliers.id')
            ->select('inventory_purchase_orders.id', 'inventory_purchase_orders.po_purchased_date', 'inventory_purchase_orders.amount_payable', 'inventory_purchase_orders.payment_type' ,'suppliers.supplier_title')
            ->get();

        $customer_transactions = CustomerAccount::filter()->where('customer_accounts.outlet_id', session('outlet_id'))
            ->leftJoin('customers', 'customer_accounts.customer_id', '=', 'customers.id')
            ->select('customer_accounts.id', 'customers.customer_name', 'customer_accounts.amount', 'customer_accounts.payment_type', 'customer_accounts.order_id', 'customer_accounts.payment_date')
            ->get();

       return view('pages.reports.trans_report.trans_report', compact('customers', 'suppliers', 'sales_transactions', 'purchase_transactions', 'customer_transactions', 'fromDate', 'toDate'));
    }
}
