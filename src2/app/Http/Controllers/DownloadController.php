<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function product_csv()
    {
        $filePath = public_path("downloads/products_sample.csv");
        $headers = ['Content-Type: application/csv'];
        $fileName = 'products_sample.csv';

        return response()->download($filePath, $fileName, $headers);
    }
    public function category_csv()
    {
        $filePath = public_path("downloads/categories_sample.csv");
        $headers = ['Content-Type: application/csv'];
        $fileName = 'categories_sample.csv';

        return response()->download($filePath, $fileName, $headers);
    }
    public function company_csv()
    {
        $filePath = public_path("downloads/companies_sample.csv");
        $headers = ['Content-Type: application/csv'];
        $fileName = 'companies_sample.csv';

        return response()->download($filePath, $fileName, $headers);
    }

    public function expense_category_csv()
    {
        $filePath = public_path("downloads/expense_categories_sample.csv");
        $headers = ['Content-Type: application/csv'];
        $fileName = 'expense_categories_sample.csv';

        return response()->download($filePath, $fileName, $headers);
    }

    public function supplier_csv()
    {
        $filePath = public_path("downloads/suppliers_sample.csv");
        $headers = ['Content-Type: application/csv'];
        $fileName = 'suppliers_sample.csv';

        return response()->download($filePath, $fileName, $headers);
    }
}
