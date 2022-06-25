<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ExpenseCategory;
use App\Models\ExpenseTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ExpenseApiController extends Controller
{
    public function expenses($id)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $today_expenses = DB::table('expense_transactions')->where('expense_transactions.outlet_id', $outlet->id)
                    ->whereDate('expense_transactions.created_at', Carbon::today())
                    ->leftJoin('expense_categories', 'expense_categories.id', '=', 'expense_transactions.expense_category_id')
                    ->select(
                        'expense_transactions.title as transaction_title',
                        'expense_transactions.description',
                        'expense_categories.title as category_title',
                        'expense_transactions.amount',
                        'expense_transactions.referred_user_id',
                        'expense_transactions.created_by'
                    )
                    ->get();
                return response()->json([
                    'data' =>
                    $today_expenses
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

    public function expense_categories($id)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        // return $outlet;
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $expense_categories = DB::table('expense_categories')->where('expense_categories.outlet_id', $outlet->id)
                    ->get();
                return response()->json([
                    'ExpenseCategories' =>
                    $expense_categories
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

    public function expense_transactions($id, Request $request)
    {
        $date = $request->date;
        $expense_category = $request->expense_category_id;
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        // return $outlet;
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $expense_transactions = ExpenseTransaction::filter()->where('expense_transactions.outlet_id', $outlet->id)
                    // ->whereDate('expense_transactions.created_at', $date)
                    // ->where('expense_transactions.expense_category_id', $expense_category)
                    ->leftJoin('expense_categories', 'expense_categories.id', '=', 'expense_transactions.expense_category_id')
                    ->leftJoin('employees as referred_empoyee', 'referred_empoyee.id', '=', 'expense_transactions.referred_user_id')
                    ->leftJoin('employees as creater_employee', 'creater_employee.id', '=', 'expense_transactions.created_by')
                    ->select(
                        'expense_transactions.title as transaction_title',
                        'expense_transactions.description',
                        'expense_categories.title as category_title',
                        'expense_transactions.amount',
                        'referred_empoyee.employee_name as referred_employee',
                        'creater_employee.employee_name as created_by',
                        'expense_transactions.created_at as created_at',
                    )
                    ->orderBy('expense_transactions.created_at', 'desc')
                    ->get();
                return response()->json([
                    'ExpenseTransactions' => $expense_transactions
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

    public function expense_categories_create($id, Request $request)
    {

        $outlet =  DB::table('outlets')->where('id', $id)->first();
        // return $outlet;
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $already_exists = ExpenseCategory::where('title', $request->title)->where('outlet_id', $outlet->id)->first();
                if ($already_exists) {
                    return response(
                        [
                            'message' => 'Title already exists.'
                        ],
                        401
                    );
                }

                $employee = Employee::where('outlet_id', $outlet->id)->first();
                $expense_category = new ExpenseCategory(
                    [
                        'title' => $request->title,
                        'description' => $request->description,
                        'feature_img' => 'placeholder.jpg',
                        'outlet_id' => $outlet->id,
                        'created_by' => $employee->id,
                    ]
                );
                $expense_category->save();
                return response()->json([
                    'success' => [
                        'message' => 'Record Added.'
                    ]
                ]);
            } else {
                // return response(
                //     [
                //         'statusCode' => '401',
                //         'message' => 'Sorry, you are not allowed to access this outlet.'
                //     ],
                //     401
                // );
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

    public function expense_transaction_create($id, Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'amount' => 'required|numeric',
                'expense_category_id' => 'required',
                'referred_user_id' => 'required',
                'payment_type' => 'required',
                'payment_method_id' => 'required',
            ],
            [
                'title.required' => 'Title is required.',
                'amount.required' => 'Amount is required.',
                'expense_category_id.required' => 'Please select expense category.',
                'referred_user_id.required' => 'Please select referred user.',
                'payment_type.required' => 'Please select payment type.',
                'payment_method_id.required' => 'Please select payment method.',
            ]
        );

        $outlet =  DB::table('outlets')->where('id', $id)->first();
        // return $outlet;
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $employee = Employee::where('outlet_id', $outlet->id)->first();
                $expense_transaction = new ExpenseTransaction($request->all());
                $expense_transaction->created_by = $employee->id;
                $expense_transaction->outlet_id = $outlet->id;
                $expense_transaction->save();

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
