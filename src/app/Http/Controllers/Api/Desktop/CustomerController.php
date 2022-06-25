<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\Employee;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index(Request $request)
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
            $customers = Customer::datasync()->whereIn('outlet_id', $outlet)->get();
            $customers = $customers->map(function ($item) {
                $image = $item->customer_feature_img;
                if ($image != 'placeholder.jpg' && !filter_var($image, FILTER_VALIDATE_URL)) {
                    $item->customer_feature_img = asset('storage/customers/' . $image);
                }

                return $item;
            });
            return response()->json(
                ['Customers' => $customers]
            );
        }
    }
    public function store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_customer = Customer::where('outlet_id', $field['outlet_id'])
                ->where('id', $field['id'])
                ->first();
            if ($check_customer) {
                continue;
            } else {
                if ($field['customer_feature_img'] != 'placeholder.jpg') {
                    Storage::disk('public')->put('customers/' . $field['customer_feature_img'], base64_decode($field['picture']));
                }
                $data[] = [
                    'customer_name' => $field['customer_name'],
                    'customer_gender' => $field['customer_gender'],
                    'customer_phone' => $field['customer_phone'],
                    'customer_dob' => $field['customer_dob'],
                    'customer_email' => $field['customer_email'],
                    'customer_address' => $field['customer_address'],
                    'allow_credit' =>  $field['allow_credit'],
                    'customer_cnic' => $field['customer_cnic'],
                    'customer_description' =>  $field['customer_description'],
                    'customer_feature_img' => $field['customer_feature_img'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $customer = Customer::insert($data);
        $new_records = Customer::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['Customers' => $sorted->values()->all()]
        );
    }


    public function update(Request $request)
    {
        foreach ($request->all() as $field) {
            $oldImage = Customer::where('id', $field['id'])->pluck('customer_feature_img')->first();
            if ($field['customer_feature_img'] != 'placeholder.jpg' && $oldImage != $field['customer_feature_img']) {
                //deleting the previous Image
                Storage::disk('public')->delete('customers/' . $oldImage);
                Storage::disk('public')->put('customers/' . $field['customer_feature_img'], base64_decode($field['picture']));
            }
            $customer = Customer::where('id', $field['id'])->update([
                'customer_name' => $field['customer_name'],
                'customer_gender' => $field['customer_gender'],
                'customer_phone' => $field['customer_phone'],
                'customer_dob' => $field['customer_dob'],
                'customer_email' => $field['customer_email'],
                'customer_address' => $field['customer_address'],
                'allow_credit' =>  $field['allow_credit'],
                'customer_cnic' => $field['customer_cnic'],
                'customer_description' =>  $field['customer_description'],
                'customer_feature_img' => $field['customer_feature_img'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }

        return response(["ResponseSuccess" => "success"]);
    }
    public function customer_accounts(Request $request)
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
            $customer_accounts = CustomerAccount::datasync()->whereIn('outlet_id', $outlet)->get();
            return response()->json(
                ['CustomerAccounts' => $customer_accounts]
            );
        }
    }

    public function customer_accounts_store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_customer_account = CustomerAccount::where('outlet_id', $field['outlet_id'])
                ->where('id', $field['id'])
                ->first();
            if ($check_customer_account) {
                continue;
            } else {
                $data[] = [
                    'amount' => $field['amount'],
                    'balance' => $field['balance'],
                    'payment_type' => $field['payment_type'],
                    'description' => $field['description'],
                    'payment_date' => $field['payment_date'],
                    'payment_method_id' => $field['payment_method_id'],
                    'order_id' =>  $field['order_id'],
                    'customer_id' => $field['customer_id'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at']
                ];
            }
        }
        $customer_account = CustomerAccount::insert($data);
        $new_records = CustomerAccount::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['CustomerAccounts' => $sorted->values()->all()]
        );
    }


    public function customer_accounts_update(Request $request)
    {
        foreach ($request->all() as $field) {
            $customer_account = CustomerAccount::where('id', $field['id'])->update([
                'amount' => $field['amount'],
                'balance' => $field['balance'],
                'payment_type' => $field['payment_type'],
                'description' => $field['description'],
                'payment_date' => $field['payment_date'],
                'payment_method_id' => $field['payment_method_id'],
                'order_id' =>  $field['order_id'],
                'customer_id' => $field['customer_id'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at']
            ]);
        }

        return response(["ResponseSuccess" => "success"]);
    }
}
