<?php

namespace App\Http\Controllers;

use App\Classes\Subscriber;
use App\Models\Customer;
use App\Models\CustomerAccount;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerTransactionController extends Controller
{
    public function index()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $customers = Customer::where('outlet_id', session('outlet_id'))->pluck('customer_name', 'id');
        // $customer_transactions = [];
        $customer_transactions = CustomerAccount::filter()
            ->leftJoin('customers', 'customers.id', '=', 'customer_accounts.customer_id')
            ->leftJoin('outlets', 'outlets.id', '=', 'customer_accounts.outlet_id')
            ->leftJoin('users', 'customer_accounts.created_by', '=', 'users.id')
            ->where('customer_accounts.outlet_id', session('outlet_id'))
            ->get();

        return view('pages.customer_account.transaction_summary', compact('customers', 'customer_transactions'));
    }

    public function filter()
    {

        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $customers = Customer::where('outlet_id', session('outlet_id'))->pluck('customer_name', 'id');
        $customer_transactions = CustomerAccount::filter()
            ->leftJoin('customers', 'customers.id', '=', 'customer_accounts.customer_id')
            ->where('customer_accounts.outlet_id', session('outlet_id'))
            ->get();
        return view('pages.customer_account.transaction_summary', compact('customers', 'customer_transactions'));
    }
}
