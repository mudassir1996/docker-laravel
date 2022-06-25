<?php

namespace App\Http\Controllers;

use App\Classes\Subscriber;
use App\Models\Business;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\PaymentMethod;
use App\Models\PaymentType;
use App\Models\Sales\SalesOrder;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\Response;

class CustomerAccountController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('customer_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }



        $customer_accounts = DB::table('customer_accounts')
            ->select('customer_accounts.*', 'outlets.outlet_title', 'payment_types.title as payment_type_title', 'employees.employee_name', 'customers.customer_name', 'payment_methods.payment_title')
            ->leftJoin('customers', 'customer_accounts.customer_id', '=', 'customers.id')
            ->leftJoin('payment_methods', 'customer_accounts.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'customer_accounts.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'customer_accounts.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'customer_accounts.created_by', '=', 'employees.id')
            ->where('customer_accounts.outlet_id', session('outlet_id'))
            ->latest('customer_accounts.updated_at')
            ->get();
        return view('pages.customer_account.accounts', compact('customer_accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('customer_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $payment_types = PaymentType::where('outlet_id', session('outlet_id'))->get();
        $payment_methods = PaymentMethod::where('outlet_id', session('outlet_id'))->get();
        $customers = Customer::where('outlet_id', session('outlet_id'))->latest()->select('id', 'customer_name', 'allow_credit')->get();
        return view('pages.customer_account.add_payment', compact('payment_types', 'payment_methods', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        //validating image (filetypes:jpg,png, maxsize:2MB)
        $request->validate(
            [
                'customer_id' => 'required',
                'amount' => 'required|numeric',
                'payment_type' => 'required',
                'payment_date' => 'required',
                'payment_method_id' => 'required',
            ],
            [
                'customer_id.required' => 'Please select a customer.',
                'amount.required' => 'Amount is required.',
                'payment_type.required' => 'Please select a payment type.',
                'payment_date.required' => 'Please select payment date.',
                'payment_method_id.required' => 'Please select a payment method.',
            ]
        );
        // dd($request->hidden_allow_credit);
        $payment_type = DB::table('payment_types')->where('id', $request->payment_type)->first();
        $customer_balance = CustomerAccount::where('customer_id', $request->customer_id)->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
        $customer_balance = $customer_balance ?? 0;

        if ($payment_type->value == 1 && $request->hidden_allow_credit == 0 && $customer_balance < $request->amount) {

            $error = new MessageBag();
            $error->add('allow_credit', 'Credit transaction is not allow for this user');
            return back()->withInput()->withErrors($error);
        }



        DB::transaction(function () use ($request, $payment_type, $customer_balance) {

            if ($payment_type->value == 0) {
                $new_balance = $customer_balance + $request->amount;
            }
            if ($payment_type->value == 1) {
                $new_balance = $customer_balance - $request->amount;
            }



            CustomerAccount::create([
                'amount' => $request->amount,
                'balance' => $new_balance,
                'payment_type' => $request->payment_type,
                'description' => $request->description,
                'payment_date' => $request->payment_date,
                'payment_method_id' => $request->payment_method_id,
                'order_id' => $request->order_id ?? 0,
                'customer_id' => $request->customer_id,
                'outlet_id' => $request->outlet_id,
                'created_by' => $request->created_by,
            ]);

            $transaction_request = new Request([
                'amount'  => $request->amount,
                'payment_type' => $payment_type,
                'payment_method_id'  => $request->payment_method_id,
                'payment_date'  => $request->payment_date,
                'system_remarks' => 'customer_accounts',
                'description' => "Transaction added from customer account",
                'order_id' => $request->order_id ?? 0,
                'customer_id' => $request->customer_id,
            ]);

            $outlet_payment_transaction = new  OutletPaymentTransactionController();
            $outlet_payment_transaction->insert($transaction_request);
        });
        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Customer transaction added successfully!',
                'alert-type' => 'success'
            );
        }
        //setting up error message
        else {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect('outlets/customer-accounts')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('customer_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        // $customer_account = CustomerAccount::find($id);
        $customer_account = CustomerAccount::select('customer_accounts.*', 'payment_types.title as payment_type_title', 'outlets.outlet_title', 'employees.employee_name', 'customers.customer_name', 'payment_methods.payment_title')
            ->leftJoin('customers', 'customer_accounts.customer_id', '=', 'customers.id')
            ->leftJoin('payment_methods', 'customer_accounts.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'customer_accounts.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'customer_accounts.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'customer_accounts.created_by', '=', 'employees.id')
            ->where('customer_accounts.outlet_id', session('outlet_id'))
            ->where('customer_accounts.id', $id)
            ->firstOrFail();
        return view('pages.customer_account.view_payment', compact('customer_account'));
    }


    public function get_credit_orders(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $payment_type = DB::table('payment_types')->where('value', 1)->first();
        $credit_orders = SalesOrder::where('customer_id', $request->customer_id)
            ->where('payment_type', $payment_type->id)
            ->where('outlet_id', session('outlet_id'))
            ->latest()
            ->select('id', 'order_completion_date', 'amount_paid', 'amount_payable')
            ->get();

        $output = '';
        if (count($credit_orders) > 0) {
            foreach ($credit_orders as $credit_order) {
                $output .= '<tr>' .
                    '<td class="font-weight-bolder">' . $credit_order->id . '</td>' .
                    '<td class="font-weight-bolder">' . $credit_order->order_completion_date . '</td>' .
                    '<td class="font-weight-bolder">' . $credit_order->amount_paid . '</td>' .
                    '<td class="font-weight-bolder">' . $credit_order->amount_payable . '</td>' .
                    '<td class="font-weight-bolder">' .
                    '<a href="#" onclick="select_credit_order(' . $credit_order->id . ')" class="btn font-weight-bolder btn-sm btn-outline-primary mr-2 px-10">Select</a>' .
                    '</td>' .
                    '</tr>';
            }
        } else {
            $output .= '<tr>' .
                '<td class="font-weight-bolder" colspan="4"> No Credit Orders </td>';
        }


        return response($output);
    }

    public function print_transaction($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('customer_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('customer_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        // $customer_account = CustomerAccount::find($id);
        $customer_account = CustomerAccount::select('customer_accounts.*', 'payment_types.title as payment_type_title', 'outlets.outlet_title', 'outlets.outlet_address', 'outlets.outlet_phone', 'cities.city_name', 'employees.employee_name', 'customers.customer_name', 'payment_methods.payment_title')
            ->leftJoin('customers', 'customer_accounts.customer_id', '=', 'customers.id')
            ->leftJoin('payment_methods', 'customer_accounts.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'customer_accounts.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'customer_accounts.outlet_id', '=', 'outlets.id')
            ->leftJoin('cities', 'cities.id', '=', 'outlets.outlet_city')
            ->leftJoin('employees', 'customer_accounts.created_by', '=', 'employees.id')
            ->where('customer_accounts.outlet_id', session('outlet_id'))
            ->where('customer_accounts.id', $id)
            ->firstOrFail();
        return view('pages.print.print_customer_transaction', compact('customer_account'));
    }
}
