<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Outlet;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
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
            $categories = Category::datasync()->whereIn('outlet_id', $outlet)->get();
            $categories = $categories->map(function ($item) {
                $image = $item->category_feature_img;
                if ($image != 'placeholder.jpg' && !filter_var($image, FILTER_VALIDATE_URL)) {
                    $item->category_feature_img = asset('storage/categories/' . $image);
                }

                return $item;
            });
            return response()->json(
                ['Categories' => $categories]
            );
        }
    }
    public function store(Request $request)
    {

        $data = array();
        foreach ($request->all() as $field) {
            $check_category = Category::where('category_title', $field['category_title'])
                ->where('id', $field['id'])
                ->where('outlet_id', $field['outlet_id'])
                ->first();
            if ($check_category) {
                continue;
            } else {
                if ($field['category_feature_img'] != 'placeholder.jpg') {
                    Storage::disk('public')->put('categories/' . $field['category_feature_img'], base64_decode($field['picture']));
                }
                $data[] = [
                    'category_title' => $field['category_title'],
                    'category_description' =>  $field['category_description'],
                    'category_feature_img' => $field['category_feature_img'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $category = Category::insert($data);
        $new_records = Category::orderBy('id', 'desc')->take(count($data))->get();
        for ($index = 0; $index < count($new_records); $index++) {
            Product::where('category_id', $request[$index]['id'])
                ->where('outlet_id', $request[$index]['outlet_id'])
                ->update([
                    'category_id' => $new_records[$index]['id']
                ]);
        }

        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['Categories' => $sorted->values()->all()]
        );
    }


    public function update(Request $request)
    {
        foreach ($request->all() as $field) {
            $oldImage = Category::where('id', $field['id'])->pluck('category_feature_img')->first();
            if ($field['category_feature_img'] != 'placeholder.jpg' && $oldImage != $field['category_feature_img']) {
                //deleting the previous Image
                Storage::disk('public')->delete('categories/' . $oldImage);
                Storage::disk('public')->put('categories/' . $field['category_feature_img'], base64_decode($field['picture']));
            }
            $category = Category::where('id', $field['id'])->update([
                'category_title' => $field['category_title'],
                'category_description' =>  $field['category_description'],
                'category_feature_img' => $field['category_feature_img'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }
}
