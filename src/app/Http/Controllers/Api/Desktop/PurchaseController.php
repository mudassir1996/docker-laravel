<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Outlet;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->employee_id) {
            $outlet = Employee::where('employees.id', auth()->user()->employee_id)
                ->join('outlets', 'outlets.id', 'employees.outlet_id')
                ->select('outlets.id')
                ->first();
        } else {

            $outlet = Outlet::where('created_by', auth()->user()->id)->pluck('id');
        }
        if ($outlet) {
            $purchase_orders = InventoryPurchaseOrder::datasync()->whereIn('outlet_id', $outlet)->get();
            return response()->json(
                ['PurchaseOrders' => $purchase_orders]
            );
        }
    }

    public function store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_order = InventoryPurchaseOrder::where('outlet_id', $field['outlet_id'])
                ->where('id', $field['id'])
                ->first();
            if ($check_order) {
                continue;
            } else {

                $data[] = [
                    'supplier_id' => $field['supplier_id'],
                    'po_number' =>  $field['po_number'],
                    'po_request_date' =>  $field['po_request_date'],
                    'po_expected_date' =>  $field['po_expected_date'],
                    'po_purchased_date' =>  $field['po_purchased_date'],
                    'po_status' => $field['po_status'],
                    'payment_type' => $field['payment_type'],
                    'payment_method_id' => $field['payment_method_id'],
                    'total_bill' => $field['total_bill'],
                    'po_discount_value' => $field['po_discount_value'],
                    'po_discount_percentage' => $field['po_discount_percentage'],
                    'amount_payable' => $field['amount_payable'],
                    'remarks' => $field['remarks'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at']
                ];
            }
        }
        $purchase_order = InventoryPurchaseOrder::insert($data);
        $new_records = InventoryPurchaseOrder::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['PurchaseOrders' => $sorted->values()->all()]
        );
    }


    public function update(Request $request)
    {
        foreach ($request->all() as $field) {

            $purchase_order = InventoryPurchaseOrder::where('id', $field['id'])->update([
                'supplier_id' => $field['supplier_id'],
                'po_number' =>  $field['po_number'],
                'po_request_date' =>  $field['po_request_date'],
                'po_expected_date' =>  $field['po_expected_date'],
                'po_purchased_date' =>  $field['po_purchased_date'],
                'po_status' => $field['po_status'],
                'payment_type' => $field['payment_type'],
                'payment_method_id' => $field['payment_method_id'],
                'total_bill' => $field['total_bill'],
                'po_discount_value' => $field['po_discount_value'],
                'po_discount_percentage' => $field['po_discount_percentage'],
                'amount_payable' => $field['amount_payable'],
                'remarks' => $field['remarks'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }


    public function purchase_order_details(Request $request)
    {
        $outlet = Outlet::where('created_by', auth()->user()->id)->pluck('id');
        if ($outlet) {
            $purchase_order_details = InventoryPurchaseOrderDetail::datasync()->whereIn('outlet_id', $outlet)->get();
            return response()->json(
                ['PurchaseOrderDetails' => $purchase_order_details]
            );
        }
    }

    public function purchase_order_details_store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_order = InventoryPurchaseOrderDetail::where('outlet_id', $field['outlet_id'])
                ->where('id', $field['id'])
                ->first();
            if ($check_order) {
                continue;
            } else {
                $data[] = [
                    'inventory_purchase_order_id' => $field['inventory_purchase_order_id'],
                    'product_id' =>  $field['product_id'],
                    'old_cost_price' =>  $field['old_cost_price'],
                    'new_cost_price' =>  $field['new_cost_price'],
                    'requested_quantity' =>  $field['requested_quantity'],
                    'purchased_quantity' => $field['purchased_quantity'],
                    'item_total' => $field['item_total'],
                    'discount_value' => $field['discount_value'],
                    'discount_percentage' => $field['discount_percentage'],
                    'remarks' => $field['remarks'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at']
                ];
            }
        }
        $purchase_order_detail = InventoryPurchaseOrderDetail::insert($data);
        $new_records = InventoryPurchaseOrderDetail::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['PurchaseOrderDetails' => $sorted->values()->all()]
        );
    }


    public function purchase_order_details_update(Request $request)
    {
        foreach ($request->all() as $field) {
            $purchase_order_detail = InventoryPurchaseOrderDetail::where('id', $field['id'])->update([
                'inventory_purchase_order_id' => $field['inventory_purchase_order_id'],
                'product_id' =>  $field['product_id'],
                'old_cost_price' =>  $field['old_cost_price'],
                'new_cost_price' =>  $field['new_cost_price'],
                'requested_quantity' =>  $field['requested_quantity'],
                'purchased_quantity' => $field['purchased_quantity'],
                'item_total' => $field['item_total'],
                'discount_value' => $field['discount_value'],
                'discount_percentage' => $field['discount_percentage'],
                'remarks' => $field['remarks'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at']
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }
}
