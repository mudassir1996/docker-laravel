<?php

namespace App\Imports;

use App\Models\Supplier;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SupplierImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $supplier_exist = Supplier::where('supplier_title', $row['supplier_title'])
                ->where('outlet_id', session('outlet_id'))->pluck('id')->first();

            if (!$supplier_exist) {
                DB::transaction(function () use ($row) {
                    $supplier = Supplier::create([
                        'supplier_title' => $row['supplier_title'],
                        'supplier_email' => $row['supplier_email'],
                        'supplier_phone' => $row['supplier_phone'],
                        'supplier_address' => $row['supplier_address'],
                        'supplier_cnic' => $row['supplier_cnic'],
                        'supplier_description' => $row['supplier_description'],
                        'supplier_feature_img' => 'placeholder.jpg',
                        'outlet_id' => session('outlet_id'),
                        'created_by' =>  session('employee_id'),
                    ]);
                });
            }

            // dd($row['product_title']);
        }
    }
}
