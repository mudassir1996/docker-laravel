<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
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
            $companies = Company::datasync()->whereIn('outlet_id', $outlet)->get();
            $companies = $companies->map(function ($item) {
                $image = $item->company_feature_img;
                if ($image != 'placeholder.jpg' && !filter_var($image, FILTER_VALIDATE_URL)) {
                    $item->company_feature_img = asset('storage/companies/' . $image);
                }

                return $item;
            });
            return response()->json(
                ['Companies' => $companies]
            );
        }
    }

    public function store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_company = Company::where('company_title', $field['company_title'])
                ->where('outlet_id', $field['outlet_id'])
                ->where('id', $field['id'])
                ->first();
            if ($check_company) {
                continue;
            } else {
                if ($field['company_feature_img'] != 'placeholder.jpg') {
                    Storage::disk('public')->put('companies/' . $field['company_feature_img'], base64_decode($field['picture']));
                }
                $data[] = [
                    'company_title' => $field['company_title'],
                    'company_address' => $field['company_address'],
                    'company_email' => $field['company_email'],
                    'company_phone' => $field['company_phone'],
                    'company_description' =>  $field['company_description'],
                    'company_feature_img' => $field['company_feature_img'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $company = Company::insert($data);
        $new_records = Company::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['Companies' => $sorted->values()->all()]
        );
    }


    public function update(Request $request)
    {
        foreach ($request->all() as $field) {
            $oldImage = Company::where('id', $field['id'])->pluck('company_feature_img')->first();
            if ($field['company_feature_img'] != 'placeholder.jpg' && $oldImage != $field['company_feature_img']) {
                //deleting the previous Image
                Storage::disk('public')->delete('companies/' . $oldImage);
                Storage::disk('public')->put('companies/' . $field['company_feature_img'], base64_decode($field['picture']));
            }
            $company = Company::where('id', $field['id'])->update([
                'company_title' => $field['company_title'],
                'company_address' => $field['company_address'],
                'company_email' => $field['company_email'],
                'company_phone' => $field['company_phone'],
                'company_description' =>  $field['company_description'],
                'company_feature_img' => $field['company_feature_img'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }
}
