<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ExpenseCategory;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        // expense / expense - category
        if (auth()->user()->employee_id) {
            $outlet = Employee::where('employees.id', auth()->user()->employee_id)
                ->join('outlets', 'outlets.id', 'employees.outlet_id')
                ->select('outlets.id')
                ->first();
        } else {

            $outlet = Outlet::where('created_by', auth()->user()->id)->pluck('id');
        }
        if ($outlet) {
            $expense_categories = ExpenseCategory::datasync()->whereIn('outlet_id', $outlet)->get();
            $expense_categories = $expense_categories->map(function ($item) {
                $image = $item->feature_img;
                if ($image != 'placeholder.jpg' && !filter_var($image, FILTER_VALIDATE_URL)) {
                    $item->feature_img = asset('storage/expense/expense-category' . $image);
                }

                return $item;
            });
            return response()->json(
                ['ExpenseCategories' => $expense_categories]
            );
        }
    }

    public function store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_expense_category = ExpenseCategory::where('title', $field['title'])
                ->where('id', $field['id'])
                ->where('outlet_id', $field['outlet_id'])
                ->first();
            if (!$check_expense_category) {
                if ($field['feature_img'] != 'placeholder.jpg') {
                    Storage::disk('public')->put('expense/expense-category' . $field['feature_img'], base64_decode($field['picture']));
                }
                $data[] = [
                    'title' => $field['title'],
                    'description' =>  $field['description'],
                    'feature_img' =>  $field['feature_img'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $expense_category = ExpenseCategory::insert($data);
        $new_records = ExpenseCategory::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['ExpenseCategories' => $sorted->values()->all()]
        );
    }


    public function update(Request $request)
    {
        foreach ($request->all() as $field) {
            $oldImage = ExpenseCategory::where('id', $field['id'])->pluck('feature_img')->first();
            if ($field['feature_img'] != 'placeholder.jpg' && $oldImage != $field['feature_img']) {
                //deleting the previous Image
                Storage::disk('public')->delete('expense/expense-category' . $oldImage);
                Storage::disk('public')->put('expense/expense-category' . $field['feature_img'], base64_decode($field['picture']));
            }
            $expense_category = ExpenseCategory::where('id', $field['id'])->update([
                'title' => $field['title'],
                'description' =>  $field['description'],
                'feature_img' =>  $field['feature_img'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }
}
