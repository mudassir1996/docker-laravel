<?php

namespace App\Imports;

use App\Models\Company;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompanyImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $company_exist = Company::where('company_title', $row['company_title'])
                ->where('outlet_id', session('outlet_id'))->pluck('id')->first();

            if (!$company_exist) {
                DB::transaction(function () use ($row) {
                    $company = Company::create([
                        'company_title' => $row['company_title'],
                        'company_address' => $row['company_address'],
                        'company_email' => $row['company_email'],
                        'company_phone' => $row['company_phone'],
                        'company_description' => $row['company_description'],
                        'company_feature_img' => 'placeholder.jpg',
                        'outlet_id' => session('outlet_id'),
                        'created_by' =>  session('employee_id'),
                    ]);
                });
            }

            // dd($row['product_title']);
        }
    }
}
