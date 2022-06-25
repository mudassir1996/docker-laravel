<?php

namespace App\Http\Controllers;

use App\Classes\Subscriber;
use App\Models\Company;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Supplier;
use App\Models\SupplierAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class InventoryPurchaseOrderController extends Controller
{
    // public function __construct()
    // {
    //     abort_if(Gate::denies('purchase_orders'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('purchase_orders'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('po_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $suppliers = Supplier::where('outlet_id', session('outlet_id'))->select('id', 'supplier_title')->get();
        $purchase_orders = InventoryPurchaseOrder::leftJoin('suppliers', 'inventory_purchase_orders.supplier_id', '=', 'suppliers.id')
            ->leftJoin('outlets', 'inventory_purchase_orders.outlet_id', '=', 'outlets.id')
            ->leftJoin('payment_types', 'inventory_purchase_orders.payment_type', '=', 'payment_types.id')
            ->leftJoin('employees', 'inventory_purchase_orders.created_by', '=', 'employees.id')
            ->leftJoin('payment_methods', 'inventory_purchase_orders.payment_method_id', '=', 'payment_methods.id')
            ->selectRaw('inventory_purchase_orders.*')
            ->selectRaw('suppliers.supplier_title')
            ->selectRaw('payment_types.title as payment_type_title')
            ->selectRaw('payment_methods.payment_title')
            ->selectRaw('outlets.outlet_title')
            ->selectRaw('employees.employee_name')
            ->whereIn('inventory_purchase_orders.po_status', ['delivered', 'shipped', 'requested', 'in-process'])
            ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->latest()
            ->get();

        // dd(InventoryPurchaseOrder::where('outlet_id', session('outlet_id'))->get());
        return view('pages.product.po.po', compact('purchase_orders', 'suppliers'));
    }

    public function filter(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('purchase_orders'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('po_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $suppliers = Supplier::where('outlet_id', session('outlet_id'))->select('id', 'supplier_title')->get();
        $purchase_orders = InventoryPurchaseOrder::filter()->leftJoin('suppliers', 'inventory_purchase_orders.supplier_id', '=', 'suppliers.id')
            ->leftJoin('outlets', 'inventory_purchase_orders.outlet_id', '=', 'outlets.id')
            ->leftJoin('payment_types', 'inventory_purchase_orders.payment_type', '=', 'payment_types.id')
            ->leftJoin('employees', 'inventory_purchase_orders.created_by', '=', 'employees.id')
            ->leftJoin('payment_methods', 'inventory_purchase_orders.payment_method_id', '=', 'payment_methods.id')
            ->selectRaw('inventory_purchase_orders.*')
            ->selectRaw('suppliers.supplier_title')
            ->selectRaw('payment_types.title as payment_type_title')
            ->selectRaw('payment_methods.payment_title')
            ->selectRaw('outlets.outlet_title')
            ->selectRaw('employees.employee_name')
            ->whereIn('inventory_purchase_orders.po_status', ['delivered', 'shipped', 'requested', 'in-process'])
            ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->latest()
            ->get();

        // dd(InventoryPurchaseOrder::where('outlet_id', session('outlet_id'))->get());
        return view('pages.product.po.po', compact('purchase_orders', 'suppliers'));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('purchase_orders'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('po_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        return view('pages.product.po.add_order');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('purchase_orders'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('po_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $order = InventoryPurchaseOrder::select('inventory_purchase_orders.*', 'suppliers.supplier_title', 'suppliers.supplier_address', 'payment_methods.payment_title', 'outlets.outlet_title', 'outlets.outlet_address', 'users.username')
            ->leftJoin('suppliers', 'inventory_purchase_orders.supplier_id', '=', 'suppliers.id')
            ->leftJoin('outlets', 'inventory_purchase_orders.outlet_id', '=', 'outlets.id')
            ->leftJoin('users', 'inventory_purchase_orders.created_by', '=', 'users.id')
            ->leftJoin('payment_methods', 'inventory_purchase_orders.payment_method_id', '=', 'payment_methods.id')
            ->where('inventory_purchase_orders.id', $id)
            ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->firstOrFail();

        $order_details = DB::table('inventory_purchase_order_details as ipod')
            ->select('ipod.requested_quantity', 'ipod.purchased_quantity', 'ipod.old_cost_price', 'ipod.new_cost_price', 'ipod.discount_value', 'ipod.item_total', 'products.product_title')
            ->leftJoin('products', 'ipod.product_id', '=', 'products.id')
            ->where('ipod.inventory_purchase_order_id', $id)
            ->get();
        return view('pages.product.po.po_details', compact('order_details', 'order'));
    }

    public function edit($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('purchase_orders'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('pages.product.po.edit_order');
    }



    public function return_history()
    {
        abort_if(Gate::denies('purchase_orders'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('po_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $purchase_orders = InventoryPurchaseOrder::leftJoin('suppliers', 'inventory_purchase_orders.supplier_id', '=', 'suppliers.id')
            ->leftJoin('outlets', 'inventory_purchase_orders.outlet_id', '=', 'outlets.id')
            // ->leftJoin('inventory_purchase_order_details', 'inventory_purchase_orders.id', '=', 'inventory_purchase_order_details.inventory_purchase_order_id')
            ->leftJoin('employees', 'inventory_purchase_orders.created_by', '=', 'employees.id')
            ->leftJoin('payment_methods', 'inventory_purchase_orders.payment_method_id', '=', 'payment_methods.id')
            ->selectRaw('inventory_purchase_orders.*')
            ->selectRaw('suppliers.supplier_title')
            ->selectRaw('payment_methods.payment_title')
            ->selectRaw('outlets.outlet_title')
            ->selectRaw('employees.employee_name')
            ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->where('inventory_purchase_orders.po_status', 'returned')
            ->latest()
            ->get();

        // dd($purchase_orders);
        return view('pages.product.po.orders_history', compact('purchase_orders'));
    }

    public function other_history()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('purchase_orders'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('po_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $purchase_orders = InventoryPurchaseOrder::leftJoin('outlets', 'inventory_purchase_orders.outlet_id', '=', 'outlets.id')
            // ->leftJoin('inventory_purchase_order_details', 'inventory_purchase_orders.id', '=', 'inventory_purchase_order_details.inventory_purchase_order_id')
            ->leftJoin('employees', 'inventory_purchase_orders.created_by', '=', 'employees.id')
            ->leftJoin('payment_methods', 'inventory_purchase_orders.payment_method_id', '=', 'payment_methods.id')
            ->selectRaw('inventory_purchase_orders.*')
            // ->selectRaw('suppliers.supplier_title')
            ->selectRaw('payment_methods.payment_title')
            ->selectRaw('outlets.outlet_title')
            ->selectRaw('employees.employee_name')
            ->whereIn('inventory_purchase_orders.po_status', ['lost', 'stolen', 'expired', 'invalid-entry'])
            ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->latest()
            ->get();

        // dd($purchase_orders);
        return view('pages.product.po.orders_history', compact('purchase_orders'));
    }
    public function return_supplier_history()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('purchase_orders'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('po_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $purchase_orders = InventoryPurchaseOrder::leftJoin('suppliers', 'inventory_purchase_orders.supplier_id', '=', 'suppliers.id')
            ->leftJoin('outlets', 'inventory_purchase_orders.outlet_id', '=', 'outlets.id')
            // ->leftJoin('inventory_purchase_order_details', 'inventory_purchase_orders.id', '=', 'inventory_purchase_order_details.inventory_purchase_order_id')
            ->leftJoin('employees', 'inventory_purchase_orders.created_by', '=', 'employees.id')
            ->leftJoin('payment_methods', 'inventory_purchase_orders.payment_method_id', '=', 'payment_methods.id')
            ->selectRaw('inventory_purchase_orders.*')
            ->selectRaw('suppliers.supplier_title')
            ->selectRaw('payment_methods.payment_title')
            ->selectRaw('outlets.outlet_title')
            ->selectRaw('employees.employee_name')
            ->whereIn('inventory_purchase_orders.po_status', ['return-to-supplier'])
            ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->latest()
            ->get();

        // dd($purchase_orders);
        return view('pages.product.po.po', compact('purchase_orders'));
    }
}
