<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index($id)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $suppliers = Supplier::where('outlet_id', $id)
                    ->select('id', 'supplier_title')->get();
                return response()->json([
                    'Suppliers' => $suppliers
                ]);
            } else {
                return response(
                    [
                        'message' => 'Sorry, you are not allowed to access this outlet.'
                    ],
                    401
                );
            }
        } else {
            return response(
                [
                    'message' => 'Sorry, you are not allowed to access this outlet.'
                ],
                401
            );
        }
    }

    public function store(Request $request, $id)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        // return $outlet;
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $employee = Employee::where('outlet_id', $outlet->id)->first();
                $supplier = Supplier::create(
                    [
                        'supplier_title' => $request->get('supplier_title'),
                        'supplier_phone' => $request->get('supplier_phone'),
                        'supplier_feature_img' => 'placeholder.jpg',
                        'outlet_id' => $outlet->id,
                        'created_by' => $employee->id
                    ]
                );
                $supplier->save();
                return response()->json([
                    'success' => [
                        'message' => 'Record Added.'
                    ]
                ]);
            } else {
                return response(
                    [
                        'message' => 'Sorry, you are not allowed to access this outlet.'
                    ],
                    401
                );
            }
        } else {
            return response(
                [
                    'message' => 'Sorry, you are not allowed to access this outlet.'
                ],
                401
            );
        }
    }
}
