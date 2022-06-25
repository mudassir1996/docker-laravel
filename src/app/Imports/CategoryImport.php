<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $category_exist = Category::where('category_title', $row['category_title'])
                ->where('outlet_id', session('outlet_id'))->pluck('id')->first();

            if (!$category_exist) {
                DB::transaction(function () use ($row) {
                    $category = Category::create([
                        'category_title' => $row['category_title'],
                        'category_description' => $row['category_description'],
                        'category_feature_img' => 'placeholder.jpg',
                        'outlet_id' => session('outlet_id'),
                        'created_by' =>  session('employee_id'),
                    ]);
                });
            }

            // dd($row['product_title']);
        }
    }
}
