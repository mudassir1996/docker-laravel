<?php

namespace App\Http\Controllers;

use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\PaymentMethod;
use App\Models\PaymentType;
use App\Models\Supplier;
use App\Models\SupplierAccount;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SupplierAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('supplier_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }



        $supplier_accounts = SupplierAccount::select('supplier_accounts.*', 'payment_types.title as payment_type_title', 'outlets.outlet_title', 'employees.employee_name', 'suppliers.supplier_title', 'payment_methods.payment_title')
            ->leftJoin('suppliers', 'supplier_accounts.supplier_id', '=', 'suppliers.id')
            ->leftJoin('payment_methods', 'supplier_accounts.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'supplier_accounts.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'supplier_accounts.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'supplier_accounts.created_by', '=', 'employees.id')
            ->where('supplier_accounts.outlet_id', session('outlet_id'))
            ->latest('supplier_accounts.updated_at')
            ->get();

        // dd($supplier_accounts);
        return view('pages.supplier.supplier_account.accounts', compact('supplier_accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('supplier_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $payment_types = PaymentType::where('outlet_id', session('outlet_id'))->get();
        $payment_methods = PaymentMethod::where('outlet_id', session('outlet_id'))->get();
        $suppliers = Supplier::where('outlet_id', session('outlet_id'))->select('id', 'supplier_title')->get();
        return view('pages.supplier.supplier_account.add_payment', compact('payment_types', 'payment_methods', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        //validating image (filetypes:jpg,png, maxsize:2MB)
        $request->validate(
            [
                'supplier_id' => 'required',
                'amount' => 'required|numeric',
                'payment_type' => 'required',
                'payment_date' => 'required',
                'payment_method_id' => 'required',

            ],
            [
                'supplier_id.required' => 'Please select a supplier.',
                'amount.required' => 'Amount is required.',
                'payment_type.required' => 'Please select a payment type.',
                'payment_date.required' => 'Please select payment date.',
                'payment_method_id.required' => 'Please select a payment method.',
            ]
        );



        DB::transaction(function () use ($request) {

            $balance = SupplierAccount::where('supplier_id', $request->supplier_id)->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();

            $balance = $balance ?? 0;
            $payment_type = DB::table('payment_types')->where('id', $request->payment_type)->first();
            if ($payment_type->value == 1) {
                $new_balance = $balance - $request->amount;
            } else {
                $new_balance = $balance + $request->amount;
            }



            SupplierAccount::create([
                'amount' => $request->amount,
                'balance' => $new_balance,
                'payment_type' => $request->payment_type,
                'description' => $request->description,
                'payment_date' => $request->payment_date,
                'payment_method_id' => $request->payment_method_id,
                'order_id' => $request->order_id ?? 0,
                'supplier_id' => $request->supplier_id,
                'outlet_id' => $request->outlet_id,
                'created_by' => $request->created_by,
            ]);

            $transaction_request = new Request([
                'amount'  => $request->amount,
                'payment_type' => $payment_type,
                'payment_method_id'  => $request->payment_method_id,
                'payment_date'  => $request->payment_date,
                'system_remarks' => 'supplier_accounts',
                'description' => "Transaction added from supplier account",
                'order_id' => $request->order_id,
                'supplier_id' => $request->supplier_id,
            ]);

            $outlet_payment_transaction = new  OutletPaymentTransactionController();
            $outlet_payment_transaction->insert($transaction_request);
        });
        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Supplier transaction added successfully!',
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
        return redirect('outlets/supplier-accounts')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('supplier_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        // $customer_account = CustomerAccount::find($id);
        $supplier_account = SupplierAccount::select('supplier_accounts.*', 'payment_types.title as payment_type_title', 'outlets.outlet_title', 'employees.employee_name', 'suppliers.supplier_title', 'payment_methods.payment_title')
            ->leftJoin('suppliers', 'supplier_accounts.supplier_id', '=', 'suppliers.id')
            ->leftJoin('payment_methods', 'supplier_accounts.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'supplier_accounts.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'supplier_accounts.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'supplier_accounts.created_by', '=', 'employees.id')
            ->where('supplier_accounts.outlet_id', session('outlet_id'))
            ->where('supplier_accounts.id', $id)
            ->firstOrFail();
        return view('pages.supplier.supplier_account.view_payment', compact('supplier_account'));
    }

    public function get_credit_orders(Request $request)
    {
        $payment_type = DB::table('payment_types')->where('outlet_id', session('outlet_id'))->where('value', 1)->first();
        $credit_orders = InventoryPurchaseOrder::where('supplier_id', $request->supplier_id)
            ->where('payment_type', $payment_type->id)
            ->where('po_status', 'delivered')
            ->where('outlet_id', session('outlet_id'))
            ->latest()
            ->select('id', 'po_purchased_date', 'amount_payable')
            ->get();

        $output = '';
        if (count($credit_orders) > 0) {
            foreach ($credit_orders as $credit_order) {
                $output .= '<tr>' .
                    '<td class="font-weight-bolder">' . $credit_order->id . '</td>' .
                    '<td class="font-weight-bolder">' . $credit_order->po_purchased_date . '</td>' .

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

    public function summary()
    {
        $suppliers = Supplier::where('outlet_id', session('outlet_id'))->pluck('supplier_title', 'id');
        // $customer_transactions = [];
        $supplier_transactions = SupplierAccount::filter()
            ->leftJoin('suppliers', 'suppliers.id', '=', 'supplier_accounts.supplier_id')
            ->leftJoin('payment_types', 'supplier_accounts.payment_type', '=', 'payment_types.id')
            ->select('supplier_accounts.*', 'payment_types.title as payment_type_title')
            ->where('supplier_accounts.outlet_id', session('outlet_id'))
            ->get();

        return view('pages.supplier.supplier_account.transaction_summary', compact('suppliers', 'supplier_transactions'));
    }

    public function filter()
    {
        $suppliers = Supplier::where('outlet_id', session('outlet_id'))->pluck('supplier_title', 'id');
        $supplier_transactions = SupplierAccount::filter()
            ->leftJoin('suppliers', 'suppliers.id', '=', 'supplier_accounts.supplier_id')
            ->leftJoin('outlets', 'outlets.id', '=', 'supplier_accounts.outlet_id')
            ->leftJoin('employees', 'supplier_accounts.created_by', '=', 'employees.id')
            ->where('supplier_accounts.outlet_id', session('outlet_id'))
            ->get();
        return view('pages.supplier.supplier_account.transaction_summary', compact('suppliers', 'supplier_transactions'));
    }

    public function print_transaction($id)
    {
        abort_if(Gate::denies('supplier_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        // $customer_account = CustomerAccount::find($id);
        $supplier_account = SupplierAccount::select('supplier_accounts.*', 'payment_types.title as payment_type_title', 'outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'employees.employee_name', 'suppliers.supplier_title', 'payment_methods.payment_title')
            ->leftJoin('suppliers', 'supplier_accounts.supplier_id', '=', 'suppliers.id')
            ->leftJoin('payment_methods', 'supplier_accounts.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'supplier_accounts.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'supplier_accounts.outlet_id', '=', 'outlets.id')
            ->leftJoin('cities', 'outlets.outlet_city', '=', 'cities.id')
            ->leftJoin('employees', 'supplier_accounts.created_by', '=', 'employees.id')
            ->where('supplier_accounts.outlet_id', session('outlet_id'))
            ->where('supplier_accounts.id', $id)
            ->firstOrFail();
        return view('pages.print.print-supplier-transaction', compact('supplier_account'));
    }
}
