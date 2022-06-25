<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Outlet;
use App\Models\Supplier;
use App\Models\SupplierAccount;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
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
            $suppliers = Supplier::datasync()->whereIn('outlet_id', $outlet)->get();
            // return $supplier
            $suppliers = $suppliers->map(function ($item) {
                $image = $item->supplier_feature_img;
                if ($image != 'placeholder.jpg' && !filter_var($image, FILTER_VALIDATE_URL)) {
                    $item->supplier_feature_img = asset('storage/suppliers/' . $image);
                }

                return $item;
            });
            return response()->json(
                ['Suppliers' => $suppliers]
            );
        }
    }

    public function store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_supplier = Supplier::where('outlet_id', $field['outlet_id'])
                ->where('supplier_title', $field['supplier_title'])
                ->where('id', $field['id'])
                ->first();
            if ($check_supplier) {
                continue;
            } else {
                if ($field['supplier_feature_img'] != 'placeholder.jpg') {
                    Storage::disk('public')->put('suppliers/' . $field['supplier_feature_img'], base64_decode($field['picture']));
                }
                $data[] = [
                    'supplier_title' => $field['supplier_title'],
                    'supplier_address' => $field['supplier_address'],
                    'supplier_cnic' => $field['supplier_cnic'],
                    'supplier_email' => $field['supplier_email'],
                    'supplier_phone' => $field['supplier_phone'],
                    'supplier_description' =>  $field['supplier_description'],
                    'supplier_feature_img' => $field['supplier_feature_img'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $supplier = Supplier::insert($data);
        $new_records = Supplier::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['Suppliers' => $sorted->values()->all()]
        );
    }


    public function update(Request $request)
    {
        foreach ($request->all() as $field) {
            $oldImage = Supplier::where('id', $field['id'])->pluck('supplier_feature_img')->first();
            if ($field['supplier_feature_img'] != 'placeholder.jpg' && $oldImage != $field['supplier_feature_img']) {
                //deleting the previous Image
                Storage::disk('public')->delete('suppliers/' . $oldImage);
                Storage::disk('public')->put('suppliers/' . $field['supplier_feature_img'], base64_decode($field['picture']));
            }
            $supplier = Supplier::where('id', $field['id'])->update([
                'supplier_title' => $field['supplier_title'],
                'supplier_address' => $field['supplier_address'],
                'supplier_cnic' => $field['supplier_cnic'],
                'supplier_email' => $field['supplier_email'],
                'supplier_phone' => $field['supplier_phone'],
                'supplier_description' =>  $field['supplier_description'],
                'supplier_feature_img' => $field['supplier_feature_img'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }

        return response(["ResponseSuccess" => "success"]);
    }

    public function supplier_companies()
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
            $last_backup_date = '';
            if (request()->last_backup_date != '') {
                $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
                $last_backup_date = $date->format('Y-m-d H:i:s');
            }

            $suppliers = Supplier::whereIn('outlet_id', $outlet)->pluck('id');
            $companies = Company::whereIn('outlet_id', $outlet)->pluck('id');
            $supplier_company = DB::table('supplier_companies')
                ->whereIn('supplier_id', $suppliers)
                ->whereIn('company_id', $companies)
                ->where('supplier_companies.updated_at', '>=', $last_backup_date)
                ->get();
            return response()->json(
                [
                    'SupplierCompanies' =>  $supplier_company,
                ]
            );
        }
    }

    public function supplier_companies_store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $data[] = [
                'supplier_id' => $field['supplier_id'],
                'company_id' => $field['company_id'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ];
        }
        $supplier_company = DB::table('supplier_companies')->insert($data);
        $new_records = DB::table('supplier_companies')->orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['SupplierCompanies' => $sorted->values()->all()]
        );
    }


    public function supplier_companies_update(Request $request)
    {
        foreach ($request->all() as $field) {
            $supplier_company = DB::table('supplier_companies')->where('id', $field['id'])->update([
                'supplier_id' => $field['supplier_id'],
                'company_id' => $field['company_id'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }

        return response(["ResponseSuccess" => "success"]);
    }



    public function supplier_accounts()
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
            $supplier_accounts = SupplierAccount::datasync()->whereIn('outlet_id', $outlet)->get();
            return response()->json(
                ['SupplierAccounts' =>  $supplier_accounts,]
            );
        }
    }

    public function supplier_accounts_store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $data[] = [
                'amount' => $field['amount'],
                'balance' => $field['balance'],
                'payment_type' => $field['payment_type'],
                'description' => $field['description'],
                'payment_date' => $field['payment_date'],
                'payment_method_id' => $field['payment_method_id'],
                'order_id' => $field['order_id'],
                'supplier_id' => $field['supplier_id'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at']
            ];
        }
        $supplier_account = SupplierAccount::insert($data);
        $new_records = SupplierAccount::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['SupplierAccounts' => $sorted->values()->all()]
        );
    }


    public function supplier_accounts_update(Request $request)
    {
        foreach ($request->all() as $field) {
            $supplier_account = SupplierAccount::where('id', $field['id'])->update([
                'amount' => $field['amount'],
                'balance' => $field['balance'],
                'payment_type' => $field['payment_type'],
                'description' => $field['description'],
                'payment_date' => $field['payment_date'],
                'payment_method_id' => $field['payment_method_id'],
                'order_id' => $field['order_id'],
                'supplier_id' => $field['supplier_id'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at']
            ]);
        }

        return response(["ResponseSuccess" => "success"]);
    }
}
