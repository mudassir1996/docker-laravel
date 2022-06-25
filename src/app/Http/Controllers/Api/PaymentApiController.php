<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentApiController extends Controller
{
    public function payment_type($id)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $payment_types = DB::table('payment_types')->where('outlet_id', $id)->select('id', 'title', 'value')->get();
                return response()->json([
                    'PaymentType' => $payment_types
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
    public function payment_method(Request $request)
    {
        $outlet =  DB::table('outlets')->where('id', $request->id)->first();
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                if ($request->payment_type_id == '') {
                    $payment_methods = DB::table('payment_methods')->leftJoin('payment_types', 'payment_types.id', 'payment_methods.payment_type_id')->where('payment_methods.outlet_id', $outlet->id)->select('payment_methods.id', 'payment_methods.payment_title', 'payment_types.value', 'payment_methods.payment_type_id')->get();
                } else {
                    $payment_methods = DB::table('payment_methods')->leftJoin('payment_types', 'payment_types.id', 'payment_methods.payment_type_id')->where('payment_methods.payment_type_id', $request->payment_type_id)->select('payment_methods.id', 'payment_methods.payment_title', 'payment_types.value', 'payment_methods.payment_type_id')->get();
                }
                return response()->json([
                    'PaymentMethod' => $payment_methods
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
