<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Outlet;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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

            $products = Product::datasync()->whereIn('outlet_id', $outlet)->get();
            $products = $products->map(function ($item) {
                $image = $item->product_feature_img;
                if ($image != 'placeholder.jpg' && !filter_var($image, FILTER_VALIDATE_URL)) {
                    $item->product_feature_img = asset('storage/products/' . $image);
                }

                return $item;
            });
            return response()->json(
                ['Products' => $products]
            );
        }
    }

    public function store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_product = Product::where('product_title', $field['product_title'])
                ->where('outlet_id', $field['outlet_id'])
                ->first();
            if ($check_product) {
                continue;
            } else {
                if ($field['product_feature_img'] != 'placeholder.jpg') {
                    Storage::disk('public')->put('products/' . $field['product_feature_img'], base64_decode($field['picture']));
                }
                $data[] = [
                    'product_title' => $field['product_title'],
                    'product_description' =>  $field['product_description'],
                    'product_barcode' =>  $field['product_barcode'],
                    'product_allow_half' =>  $field['product_allow_half'],
                    'product_status' =>  $field['product_status'],
                    'product_feature_img' => $field['product_feature_img'],
                    'category_id' => $field['category_id'],
                    'company_id' => $field['company_id'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $product = Product::insert($data);
        $new_records = Product::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['Products' => $sorted->values()->all()]
        );
    }


    public function update(Request $request)
    {
        foreach ($request->all() as $field) {
            $oldImage = Product::where('id', $field['id'])->pluck('product_feature_img')->first();
            if ($field['product_feature_img'] != 'placeholder.jpg' && $oldImage != $field['product_feature_img']) {
                //deleting the previous Image
                Storage::disk('public')->delete('products/' . $oldImage);
                Storage::disk('public')->put('products/' . $field['product_feature_img'], base64_decode($field['picture']));
            }
            $product = Product::where('id', $field['id'])->update([
                'product_title' => $field['product_title'],
                'product_description' =>  $field['product_description'],
                'product_barcode' =>  $field['product_barcode'],
                'product_allow_half' =>  $field['product_allow_half'],
                'product_status' =>  $field['product_status'],
                'product_feature_img' => $field['product_feature_img'],
                'category_id' => $field['category_id'],
                'company_id' => $field['company_id'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }
}
