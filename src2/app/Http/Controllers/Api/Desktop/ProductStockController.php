<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Outlet;
use App\Models\ProductStock;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    public function index()
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
            $product_stock = ProductStock::datasync()->whereIn('outlet_id', $outlet)->get();
            return response()->json(
                ['ProductStock' => $product_stock]
            );
        }
    }

    public function store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_product = ProductStock::where('product_id', $field['product_id'])
                ->where('outlet_id', $field['outlet_id'])
                ->first();
            if ($check_product) {
                continue;
            } else {
                $data[] = [
                    'product_id' => $field['product_id'],
                    'cost_price' =>  $field['cost_price'],
                    'retail_price' =>  $field['retail_price'],
                    'stock_keeping' =>  $field['stock_keeping'],
                    'units_in_stock' =>  $field['units_in_stock'],
                    'sku' => $field['sku'],
                    'minimum_threshold' => $field['minimum_threshold'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $product_stock = ProductStock::insert($data);
        $new_records = ProductStock::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['ProductStock' => $sorted->values()->all()]
        );
    }


    public function update(Request $request)
    {
        foreach ($request->all() as $field) {
            $product_stock = ProductStock::where('id', $field['id'])->update([
                'product_id' => $field['product_id'],
                'cost_price' =>  $field['cost_price'],
                'retail_price' =>  $field['retail_price'],
                'stock_keeping' =>  $field['stock_keeping'],
                'units_in_stock' =>  $field['units_in_stock'],
                'sku' => $field['sku'],
                'minimum_threshold' => $field['minimum_threshold'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }
}
