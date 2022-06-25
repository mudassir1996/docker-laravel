<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            DB::transaction(function () use ($row) {
                $product_exist = Product::where('product_title', $row['product_title'])
                    ->where('outlet_id', session('outlet_id'))->pluck('id')->first();

                if (!$product_exist) {
                    $category = Category::where('category_title', $row['category'])
                        ->where('outlet_id', session('outlet_id'))->pluck('id')->first();
                    $company = Company::where('company_title', $row['company'])
                        ->where('outlet_id', session('outlet_id'))->pluck('id')->first();
                    if (!$category) {
                        $new_category = Category::create([
                            'category_title' => $row['category'],
                            'category_feature_img' => 'placeholder.jpg',
                            'outlet_id' => session('outlet_id'),
                            'created_by' =>  session('employee_id'),
                            'created_at' =>  $row['created_at'],
                            'updated_at' =>  $row['updated_at'],
                        ]);

                        $category = $new_category->id;
                    }


                    if (!$company) {

                        $new_company = Company::create([
                            'company_title' => $row['company'],
                            'company_feature_img' => 'placeholder.jpg',
                            'outlet_id' => session('outlet_id'),
                            'created_by' =>  session('employee_id'),
                            'created_at' =>  $row['created_at'],
                            'updated_at' =>  $row['updated_at'],
                        ]);

                        $company = $new_company->id;
                    }


                    $product = Product::create([
                        'product_title' => $row['product_title'],
                        'product_description' => $row['product_description'],
                        'product_barcode' => $row['product_barcode'],
                        'product_allow_half' => $row['product_allow_half'],
                        'product_feature_img' => 'placeholder.jpg',
                        'product_status' => 'Active',
                        'category_id' => $category,
                        'company_id' => $company,
                        'outlet_id' => session('outlet_id'),
                        'created_by' =>  session('employee_id'),
                        'created_at' =>  $row['created_at'],
                        'updated_at' =>  $row['updated_at'],
                    ]);

                    ProductStock::create([
                        'product_id' => $product->id,
                        'cost_price' => $row['cost_price'],
                        'retail_price' => $row['retail_price'],
                        'stock_keeping' => $row['stock_keeping'],
                        'units_in_stock' => $row['units_in_stock'],
                        'sku' => $row['sku'],
                        'minimum_threshold' => $row['minimum_threshold'],
                        'outlet_id' => session('outlet_id'),
                        'created_by' =>  session('employee_id'),
                        'created_at' =>  $row['created_at'],
                        'updated_at' =>  $row['updated_at'],
                    ]);
                }
            });
            // dd($row['product_title']);
        }
    }
}
