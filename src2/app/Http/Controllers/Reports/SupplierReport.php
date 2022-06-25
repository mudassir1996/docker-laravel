<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SupplierReport extends Controller
{

   public function filterData(Request $request){
      abort_if(Gate::denies('reports_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
      if (!Auth::guard('web')->check()) {
         abort_if(Gate::denies('supplier_report'), Response::HTTP_FORBIDDEN, '403 Forbidden');
      }
        $suppliers=Supplier::where('outlet_id', session('outlet_id'))->select('id', 'supplier_title')->get();

        $supplier_details=Supplier::filter()->with(['company'])
        ->select(DB::raw('suppliers.id ,suppliers.supplier_title, sum(inventory_purchase_orders.amount_payable) as total_purchased,inventory_purchase_orders.payment_type ,count(inventory_purchase_orders.id) as orders'))
        ->leftJoin('inventory_purchase_orders', 'suppliers.id', 'inventory_purchase_orders.supplier_id')
        ->where('suppliers.outlet_id', session('outlet_id'))
        ->groupBy('inventory_purchase_orders.supplier_id')
        ->get();
        
        
        $users=User::select('id', 'username')->get();
        // dd($suppliers);
       return view('pages.reports.supplier_report.supplier_report', compact('suppliers', 'supplier_details', 'users'));
   }
}
