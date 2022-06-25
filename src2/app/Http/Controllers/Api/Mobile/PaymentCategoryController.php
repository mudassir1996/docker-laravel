<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Cashbook\PaymentCategory;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentCategoryController extends Controller
{
    public function index($id)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $payment_categories = PaymentCategory::where('outlet_id', $id)
                    ->where('payment_category_status', 'active')
                    ->select('id', 'payment_category_title')->get();
                return response()->json([
                    'PaymentCategory' => $payment_categories
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

    public function payment_categories_create($id, Request $request)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        // return $outlet;
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $already_exists = PaymentCategory::where('payment_category_title', $request->title)->first();
                if ($already_exists) {
                    return response(
                        [
                            'message' => 'Title already exists.'
                        ],
                        401
                    );
                }

                $employee = Employee::where('outlet_id', $outlet->id)->first();
                $payment_category = new PaymentCategory(
                    [
                        'payment_category_title' => $request->payment_category_title,
                        'payment_category_description' => $request->payment_category_description,
                        'payment_category_status' => $request->payment_category_status,
                        'outlet_id' => $outlet->id,
                        'created_by' => $employee->id,
                    ]
                );
                $payment_category->save();
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
