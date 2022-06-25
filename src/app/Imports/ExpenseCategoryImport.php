<?php

namespace App\Imports;

use App\Models\ExpenseCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExpenseCategoryImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            DB::transaction(function () use ($row) {
                $expense_category_exist = ExpenseCategory::where('title', $row['title'])
                    ->where('outlet_id', session('outlet_id'))->pluck('id')->first();
                if (!$expense_category_exist) {
                    $expense_category = ExpenseCategory::create([
                        'title' => $row['title'],
                        'description' => $row['description'],
                        'feature_img' => 'placeholder.jpg',
                        'outlet_id' => session('outlet_id'),
                        'created_by' =>  session('employee_id'),
                    ]);
                }
            });
            // dd($row['product_title']);
        }
    }
}
