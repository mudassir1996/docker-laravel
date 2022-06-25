<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
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
            $employees = Employee::datasync()->whereIn('outlet_id', $outlet)->get();
            $employees = $employees->map(function ($item) {
                $image = $item->employee_feature_img;
                if ($image != 'placeholder.jpg' && !filter_var($image, FILTER_VALIDATE_URL)) {
                    $item->employee_feature_img = asset('storage/employees/' . $image);
                }

                return $item;
            });
            return response()->json(
                ['Employees' => $employees]
            );
        }
    }

    public function store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_employee = Employee::where('outlet_id', $field['outlet_id'])
                ->where('id', $field['id'])
                ->first();
            if ($check_employee) {
                continue;
            } else {
                if ($field['employee_feature_img'] != 'placeholder.jpg') {
                    Storage::disk('public')->put('employees/' . $field['employee_feature_img'], base64_decode($field['picture']));
                }

                $data[] = [
                    'employee_name' => $field['employee_name'],
                    'employee_gender' =>  $field['employee_gender'],
                    'employee_phone' =>  $field['employee_phone'],
                    'employee_phone' =>  $field['employee_dob'],
                    'employee_email' =>  $field['employee_email'],
                    'employee_address' =>  $field['employee_address'],
                    'employee_cnic' =>  $field['employee_cnic'],
                    'employee_status' =>  $field['employee_status'],
                    'employee_description' =>  $field['employee_description'],
                    'employee_feature_img' => $field['employee_feature_img'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $employee = Employee::insert($data);
        $new_records = Employee::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['Employees' => $sorted->values()->all()]
        );
    }


    public function update(Request $request)
    {
        foreach ($request->all() as $field) {
            $oldImage = Employee::where('id', $field['id'])->pluck('employee_feature_img')->first();
            if ($field['employee_feature_img'] != 'placeholder.jpg' && $oldImage != $field['employee_feature_img']) {
                //deleting the previous Image
                Storage::disk('public')->delete('employees/' . $oldImage);
                Storage::disk('public')->put('employees/' . $field['employee_feature_img'], base64_decode($field['picture']));
            }
            $employee = Employee::where('id', $field['id'])->update([
                'employee_name' => $field['employee_name'],
                'employee_gender' =>  $field['employee_gender'],
                'employee_phone' =>  $field['employee_phone'],
                'employee_phone' =>  $field['employee_dob'],
                'employee_email' =>  $field['employee_email'],
                'employee_address' =>  $field['employee_address'],
                'employee_cnic' =>  $field['employee_cnic'],
                'employee_status' =>  $field['employee_status'],
                'employee_description' =>  $field['employee_description'],
                'employee_feature_img' => $field['employee_feature_img'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }
}
