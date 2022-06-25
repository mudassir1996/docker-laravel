<?php

namespace App\Http\Controllers\Airlines;

use App\Http\Controllers\Controller;
use App\Http\Controllers\OutletPaymentTransactionController;
use App\Models\Airlines\Party;
use App\Models\Airlines\PartyAccount;
use App\Models\PaymentMethod;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

class PartyAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $party_accounts_transactions = PartyAccount::where('party_accounts.outlet_id', session('outlet_id'))
            ->leftJoin('parties', 'parties.id', 'party_accounts.party_id')
            ->leftJoin('payment_types', 'payment_types.id', 'party_accounts.payment_type')
            ->leftJoin('payment_methods', 'payment_methods.id', 'party_accounts.payment_method_id')
            ->leftJoin('employees', 'employees.id', 'party_accounts.created_by')
            ->orderBy('party_accounts.id', 'desc')
            ->select(
                'party_accounts.*',
                'parties.party_title',
                'payment_types.title as payment_type_title',
                'payment_methods.payment_title as payment_method_title',
                'employees.employee_name'
            )
            ->get();
        // dd($party_accounts);
        return view('pages.airlines.party-accounts.parties-transactions', compact('party_accounts_transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_methods = PaymentMethod::where('outlet_id', session('outlet_id'))->get();
        $payment_types = PaymentType::where('outlet_id', session('outlet_id'))->get();
        $parties = Party::where('outlet_id', session('outlet_id'))->latest()->get();
        return view('pages.airlines.party-accounts.add-transaction', compact('payment_methods', 'payment_types', 'parties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validating image (filetypes:jpg,png, maxsize:2MB)
        $request->validate(
            [
                'party_id' => 'required',
                'amount' => 'required|numeric',
                'payment_type' => 'required',
                'payment_date' => 'required',
                'payment_method_id' => 'required',
            ],
            [
                'party_id.required' => 'Please select a party.',
                'amount.required' => 'Amount is required.',
                'payment_type.required' => 'Please select a payment type.',
                'payment_date.required' => 'Please select payment date.',
                'payment_method_id.required' => 'Please select a payment method.',
            ]
        );
        $is_allow_credit = Party::where('id', $request->party_id)->where('outlet_id', session('outlet_id'))->pluck('allow_credit')->first();
        $payment_type = DB::table('payment_types')->where('id', $request->payment_type)->first();
        $party_balance = PartyAccount::where('party_id', $request->party_id)->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
        $party_balance = $party_balance ?? 0;

        // if ($payment_type->value == 1 && !$is_allow_credit && $party_balance < $request->amount) {

        //     $error = new MessageBag();
        //     $error->add('amount', 'Not enough balance.');
        //     return back()->withInput()->withErrors($error);
        // }
        DB::transaction(function () use ($request, $payment_type, $party_balance) {

            if ($payment_type->value == 0) {
                $new_balance = $party_balance - $request->amount;
            }
            if ($payment_type->value == 1) {
                $new_balance = $party_balance + $request->amount;
            }

            PartyAccount::create([
                'party_id' => $request->party_id,
                'amount' => $request->amount,
                'balance' => $new_balance,
                'payment_type' => $request->payment_type,
                'payment_method_id' => $request->payment_method_id,
                'system_remarks' => 'add_party_transaction',
                'description' => $request->description,
                'payment_date' => $request->payment_date,
                'order_id' => $request->order_id ?? 0,
                'outlet_id' => session('outlet_id'),
                'created_by' => session('employee_id'),
            ]);

            $transaction_request = new Request([
                'amount'  => $request->amount,
                'payment_type' => $payment_type,
                'payment_method_id'  => $request->payment_method_id,
                'payment_date'  => $request->payment_date,
                'system_remarks' => 'add_party_transaction',
                'description' => "Transaction added from parties account",
                'order_id' => $request->order_id,
                'customer_id' => $request->party_id,
                'supplier_id' => $request->party_id,
            ]);

            $outlet_payment_transaction = new  OutletPaymentTransactionController();
            $outlet_payment_transaction->insert($transaction_request);
        });


        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Party transaction added successfully!',
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
        return redirect()->route('party-accounts.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $party_account = PartyAccount::select('party_accounts.*', 'payment_types.title as payment_type_title', 'outlets.outlet_title', 'employees.employee_name', 'parties.party_title', 'payment_methods.payment_title')
            ->leftJoin('parties', 'party_accounts.party_id', '=', 'parties.id')
            ->leftJoin('payment_methods', 'party_accounts.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'party_accounts.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'party_accounts.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'party_accounts.created_by', '=', 'employees.id')
            ->where('party_accounts.outlet_id', session('outlet_id'))
            ->where('party_accounts.id', $id)
            ->firstOrFail();
        return view('pages.airlines.party-accounts.view-payment', compact('party_account'));
    }

    public function summary()
    {
        $parties = Party::where('outlet_id', session('outlet_id'))->pluck('party_title', 'id');
        // $customer_transactions = [];
        $party_transactions = PartyAccount::filter()
            ->leftJoin('parties', 'parties.id', '=', 'party_accounts.party_id')
            ->leftJoin('payment_types', 'party_accounts.payment_type', '=', 'payment_types.id')
            ->select('party_accounts.*', 'payment_types.title as payment_type_title')
            ->where('party_accounts.outlet_id', session('outlet_id'))
            ->get();

        // dd($party_transactions);

        return view('pages.airlines.party-accounts.transaction-summary', compact('parties', 'party_transactions'));
    }

    public function print_transaction($id)
    {
        $party_account = PartyAccount::select('party_accounts.*', 'payment_types.title as payment_type_title', 'outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'employees.employee_name', 'parties.party_title', 'payment_methods.payment_title')
            ->leftJoin('parties', 'party_accounts.party_id', '=', 'parties.id')
            ->leftJoin('payment_methods', 'party_accounts.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'party_accounts.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'party_accounts.outlet_id', '=', 'outlets.id')
            ->leftJoin('cities', 'outlets.outlet_city', '=', 'cities.id')
            ->leftJoin('employees', 'party_accounts.created_by', '=', 'employees.id')
            ->where('party_accounts.outlet_id', session('outlet_id'))
            ->where('party_accounts.id', $id)
            ->firstOrFail();
        return view('pages.print.print-party-transaction', compact('party_account'));
    }
}
