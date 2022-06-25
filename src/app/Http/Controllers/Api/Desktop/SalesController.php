<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Outlet;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesOrderDetail;
use Illuminate\Http\Request;

class SalesController extends Controller
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
            $sales_orders = SalesOrder::datasync()->whereIn('outlet_id', $outlet)->get();
            return response()->json(
                ['SalesOrders' => $sales_orders]
            );
        }
    }

    public function store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_sales_orders = SalesOrder::where('id', $field['id'])
                ->where('outlet_id', $field['outlet_id'])
                ->first();
            if ($check_sales_orders) {
                continue;
            } else {

                $data[] = [
                    'customer_id' => $field['customer_id'],
                    'total_bill' =>  $field['total_bill'],
                    'so_discount_value' =>  $field['so_discount_value'],
                    'so_discount_percentage' =>  $field['so_discount_percentage'],
                    'so_tax_value' =>  $field['so_tax_value'],
                    'so_tax_percentage' => $field['so_tax_percentage'],
                    'amount_payable' => $field['amount_payable'],
                    'amount_paid' => $field['amount_paid'],
                    'change_back' => $field['change_back'],
                    'profit_percentage' => $field['profit_percentage'],
                    'profit_value' => $field['profit_value'],
                    'so_status' => $field['so_status'],
                    'payment_type' => $field['payment_type'],
                    'payment_method_id' => $field['payment_method_id'],
                    'remarks' => $field['remarks'],
                    'order_completion_date' => $field['order_completion_date'],
                    'processing_person_id' => $field['processing_person_id'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $sales_order = SalesOrder::insert($data);
        $new_records = SalesOrder::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['SalesOrders' => $sorted->values()->all()]
        );
    }


    public function update(Request $request)
    {
        foreach ($request->all() as $field) {
            $sales_order = SalesOrder::where('id', $field['id'])->update([
                'customer_id' => $field['customer_id'],
                'total_bill' =>  $field['total_bill'],
                'so_discount_value' =>  $field['so_discount_value'],
                'so_discount_percentage' =>  $field['so_discount_percentage'],
                'so_tax_value' =>  $field['so_tax_value'],
                'so_tax_percentage' => $field['so_tax_percentage'],
                'amount_payable' => $field['amount_payable'],
                'amount_paid' => $field['amount_paid'],
                'change_back' => $field['change_back'],
                'profit_percentage' => $field['profit_percentage'],
                'profit_value' => $field['profit_value'],
                'so_status' => $field['so_status'],
                'payment_type' => $field['payment_type'],
                'payment_method_id' => $field['payment_method_id'],
                'remarks' => $field['remarks'],
                'order_completion_date' => $field['order_completion_date'],
                'processing_person_id' => $field['processing_person_id'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }



    public function sales_order_details(Request $request)
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
            $sales_order_details = SalesOrderDetail::datasync()->whereIn('outlet_id', $outlet)->get();
            return response()->json(
                ['SalesOrderDetails' => $sales_order_details]
            );
        }
    }


    public function sales_order_details_store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_sales_order_details = SalesOrderDetail::where('id', $field['id'])
                ->where('outlet_id', $field['outlet_id'])
                ->first();
            if ($check_sales_order_details) {
                continue;
            } else {
                $data[] = [
                    'sales_order_id' => $field['sales_order_id'],
                    'product_id' =>  $field['product_id'],
                    'cost_price' =>  $field['cost_price'],
                    'retail_price' =>  $field['retail_price'],
                    'quantity' =>  $field['quantity'],
                    'total_cost' => $field['total_cost'],
                    'total_retail' => $field['total_retail'],
                    'discount_value' => $field['discount_value'],
                    'discount_percentage' => $field['discount_percentage'],
                    'tax_value' => $field['tax_value'],
                    'tax_percentage' => $field['tax_percentage'],
                    'amount_payable' => $field['amount_payable'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at']
                ];
            }
        }
        $sales_order_detail = SalesOrderDetail::insert($data);
        $new_records = SalesOrderDetail::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['SalesOrderDetails' => $sorted->values()->all()]
        );
    }


    public function sales_order_details_update(Request $request)
    {
        foreach ($request->all() as $field) {
            $sales_order_detail = SalesOrderDetail::where('id', $field['id'])->update([
                'sales_order_id' => $field['sales_order_id'],
                'product_id' =>  $field['product_id'],
                'cost_price' =>  $field['cost_price'],
                'retail_price' =>  $field['retail_price'],
                'quantity' =>  $field['quantity'],
                'total_cost' => $field['total_cost'],
                'total_retail' => $field['total_retail'],
                'discount_value' => $field['discount_value'],
                'discount_percentage' => $field['discount_percentage'],
                'tax_value' => $field['tax_value'],
                'tax_percentage' => $field['tax_percentage'],
                'amount_payable' => $field['amount_payable'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }
}
