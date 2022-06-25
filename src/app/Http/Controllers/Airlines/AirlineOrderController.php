<?php

namespace App\Http\Controllers\Airlines;

use App\Http\Controllers\Controller;
use App\Models\Airlines\AirlineOrder;
use App\Models\Airlines\AirlineTicket;
use App\Models\Airlines\CommissionDetail;
use App\Models\Airlines\DiscountDetail;
use App\Models\Airlines\OutletCommission;
use App\Models\Airlines\OutletDiscount;
use App\Models\Airlines\OutletTax;
use App\Models\Airlines\Party;
use App\Models\Airlines\PartyAccount;
use App\Models\Airlines\TicketTaxDetail;
use App\Models\Category;
use App\Models\OutletPaymentTransaction;
use App\Models\PaymentMethod;
use App\Models\PaymentType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AirlineOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_types = PaymentType::where('outlet_id', session('outlet_id'))->latest()->select('id', 'title')->get();
        $categories = Category::where('outlet_id', session('outlet_id'))->latest()->select('id', 'category_title')->get();
        $payment_methods = PaymentMethod::where('outlet_id', session('outlet_id'))->latest()->select('id', 'payment_title')->get();
        $parties = Party::where('outlet_id', session('outlet_id'))->latest()->select('id', 'party_title')->get();
        return view('pages.airlines.orders.index', compact('payment_types', 'categories', 'payment_methods', 'parties'));
    }

    public function ordersJson()
    {
        if (request()->ajax()) {
            $airline_orders  = AirlineOrder::with(['airline_tickets'])->search()->leftJoin('payment_types', 'payment_types.id', 'airline_orders.payment_type_id')
                ->leftJoin('payment_methods', 'payment_methods.id', 'airline_orders.payment_method_id')
                ->leftJoin('categories', 'categories.id', 'airline_orders.category_id')
                ->leftJoin('parties as customer_parties', 'customer_parties.id', 'airline_orders.customer_party_id')
                ->leftJoin('parties as supplier_parties', 'supplier_parties.id', 'airline_orders.supplier_party_id')
                ->leftJoin('employees as processing_employees', 'processing_employees.id', 'airline_orders.processing_person_id')
                ->leftJoin('employees as creater_employees', 'creater_employees.id', 'airline_orders.created_by')
                ->where('airline_orders.outlet_id', session('outlet_id'))
                ->orderBy('airline_orders.id', 'desc')
                ->select(
                    'airline_orders.*',
                    'payment_types.title as payment_type_title',
                    'payment_types.value as payment_value',
                    'categories.category_title',
                    'payment_methods.payment_title as payment_method_title',
                    'customer_parties.party_title as customer_party',
                    'supplier_parties.party_title as supplier_party',
                    'processing_employees.employee_name as processing_employee_name',
                    'creater_employees.employee_name as creater_employee_name',
                )
                ->get();

            return DataTables::of($airline_orders)
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parties = Party::where('outlet_id', session('outlet_id'))->latest()->get();
        $payment_types = PaymentType::where('payment_types.outlet_id', session('outlet_id'))
            ->orderBy('payment_types.title', 'asc')->get();

        $payment_methods = PaymentMethod::where('payment_methods.outlet_id', session('outlet_id'))
            ->join('payment_types', 'payment_types.id', 'payment_methods.payment_type_id')
            ->where('payment_types.value', 0)
            ->orderBy('payment_methods.payment_title', 'asc')
            ->select('payment_methods.*')
            ->get();
        $taxes = OutletTax::where('tax_status', 'active')->where('outlet_id', session('outlet_id'))->latest()->get();
        $commissions = OutletCommission::where('commission_status', 'active')->where('outlet_id', session('outlet_id'))->latest()->get();
        $discounts = OutletDiscount::where('discount_status', 'active')->where('outlet_id', session('outlet_id'))->latest()->get();
        $categories = Category::where('outlet_id', session('outlet_id'))->latest()->get();
        return view('pages.airlines.orders.create_order.create', compact('parties', 'payment_methods', 'payment_types', 'taxes', 'commissions', 'discounts', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request->ticketTaxDetails['tax_percentage'][0][0];
        DB::transaction(function () use ($request) {

            if ($request->orderData['payment_type'] == 1) {
                $payment = PaymentType::where('payment_types.value', $request->orderData['payment_type'])
                    ->where('payment_types.outlet_id', session('outlet_id'))
                    ->leftJoin('payment_methods', 'payment_types.id', 'payment_methods.payment_type_id')
                    ->select('payment_methods.id as payment_method_id', 'payment_types.id as payment_type_id', 'payment_types.value as payment_value')
                    ->first();
            } else {
                $payment = PaymentType::where('payment_types.value', $request->orderData['payment_type'])
                    ->where('payment_types.outlet_id', session('outlet_id'))
                    ->select('payment_types.id as payment_type_id', 'payment_types.value as payment_value')
                    ->first();
            }


            $airlineOrder = new AirlineOrder([
                'customer_party_id' => $request->orderData['customer_party_id'],
                'category_id' => $request->orderData['category_id'],
                'supplier_party_id' => $request->orderData['supplier_party_id'],
                'total_recievable' => $request->orderData['total_recievable'],
                'airline_payable' => $request->orderData['airline_payable'],
                'other_payable' => $request->orderData['other_payable'],
                'total_payable' => $request->orderData['total_payable'],
                'total_income' => $request->orderData['total_income'],
                'tax_value' => $request->orderData['tax_value'],
                'discount_value' => $request->orderData['discount_value'],
                'comission_value' => $request->orderData['comission_value'],
                'amount_payable' => $request->orderData['amount_payable'],
                'amount_paid' => $request->orderData['amount_paid'] ?? 0,
                'change_back' => $request->orderData['change_back'] ?? 0,
                'status' => $request->orderData['status'],
                'payment_type_id' => $payment->payment_type_id,
                'payment_method_id' =>  $request->orderData['payment_type'] == 1 ? $payment->payment_method_id : $request->orderData['payment_method_id'],
                'remarks' => 'Order Created',
                'order_completion_date' => Carbon::createFromFormat('d-m-Y', $request->orderData['order_completion_date'])->format('Y-m-d'),
                'processing_person_id' => session('employee_id'),
                'outlet_id' => session('outlet_id'),
                'created_by' => session('employee_id'),
            ]);

            $airlineOrder->save();

            for ($count = 0; $count < count($request->airlineTicket['ticket_number']); $count++) {
                // dd(Carbon::createFromFormat('d-m-Y', $request->airlineTicket['departure_date'][$count])->format('Y-m-d'));
                $airlineTicket = AirlineTicket::create([
                    'airline_order_id' => $airlineOrder->id,
                    'pax_title' => $request->airlineTicket['pax_title'][$count],
                    'pax_name' => $request->airlineTicket['pax_name'][$count],
                    'ticket_class' => $request->airlineTicket['ticket_class'][$count],
                    'flight_type' => $request->airlineTicket['flight_type'][$count],
                    'ticket_number' => $request->airlineTicket['ticket_number'][$count],
                    'flight_number' => $request->airlineTicket['flight_number'][$count],
                    'departure_date' => Carbon::createFromFormat('d-m-Y', $request->airlineTicket['departure_date'][$count])->format('Y-m-d'),
                    'sector' => $request->airlineTicket['sector'][$count],
                    'route' => $request->airlineTicket['route'][$count],
                    'pnr' => $request->airlineTicket['pnr'][$count],
                    'gds_pnr' => $request->airlineTicket['gds_pnr'][$count],
                    'remarks' => $request->airlineTicket['remarks'][$count],
                    'base_price' => $request->airlineTicket['base_price'][$count],
                    'airline_discount_value' => $request->airlineTicket['airline_discount_value'][$count],
                    'total_ticket_value' => $request->airlineTicket['total_ticket_value'][$count],
                    'total_tax_value' => $request->airlineTicket['total_tax_value'][$count],
                    'service_charges_value' => $request->airlineTicket['service_charges_value'][$count],
                    'total_amount' => $request->airlineTicket['total_amount'][$count],
                ]);
                if (Arr::has($request->ticketTaxDetails, 'tax_title')) {
                    for ($index = 0; $index < count($request->ticketTaxDetails['tax_title'][$count]); $index++) {
                        $taxDetail = new TicketTaxDetail(
                            [
                                'airline_order_id' => $airlineOrder->id,
                                'airline_ticket_id' => $airlineTicket->id,
                                'title' => $request->ticketTaxDetails['tax_title'][$count][$index],
                                'description' => $request->ticketTaxDetails['tax_description'][$count][$index],
                                'value' => $request->ticketTaxDetails['tax_value'][$count][$index],
                                'percentage' => $request->ticketTaxDetails['tax_percentage'][$count][$index],
                                'type' => $request->ticketTaxDetails['tax_type'][$count][$index],
                                'outlet_id' => session('outlet_id'),
                                'created_by' => session('employee_id'),
                            ]
                        );

                        $taxDetail->save();
                    }
                }
            }

            $discountData = [];
            for ($count = 0; $count < count($request->discountDetails['title']); $count++) {
                if ($request->discountDetails['title'][$count] != '') {
                    $discountData[] = [
                        'airline_order_id' => $airlineOrder->id,
                        'title' => $request->discountDetails['title'][$count],
                        'description' => $request->discountDetails['description'][$count],
                        'value' => $request->discountDetails['value'][$count],
                        'percentage' => $request->discountDetails['percentage'][$count],
                        'type' => $request->discountDetails['type'][$count],
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
            }
            $discountDetails = DiscountDetail::insert($discountData);

            $commissionData = [];
            for ($count = 0; $count < count($request->commissionDetails['title']); $count++) {
                if ($request->commissionDetails['title'][$count] != '') {
                    $commissionValue = explode(",", $request->commissionDetails['value']);
                    $commissionPercentage = explode(",", $request->commissionDetails['percentage']);
                    $commissionData[] = [
                        'airline_order_id' => $airlineOrder->id,
                        'title' => $request->commissionDetails['title'][$count],
                        'description' => $request->commissionDetails['description'][$count],
                        'value' => $commissionValue[$count],
                        'percentage' => $commissionPercentage[$count],
                        'type' => $request->commissionDetails['type'][$count],
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
            }
            $commissionDetails = CommissionDetail::insert($commissionData);

            $creditPayment = PaymentType::where('payment_types.value', 1)
                ->where('payment_types.outlet_id', session('outlet_id'))
                ->select('payment_types.id as payment_type_id')
                ->first();

            $debitPayment = PaymentType::where('payment_types.value', 0)
                ->where('payment_types.outlet_id', session('outlet_id'))
                ->select('payment_types.id as payment_type_id')
                ->first();


            // supplier party credit transaction
            $supplier_party_balance = PartyAccount::where(
                'party_id',
                $request->orderData['supplier_party_id']
            )->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
            $supplier_party_balance = $supplier_party_balance ?? 0;
            $new_balance = $supplier_party_balance + $request->orderData['airline_payable'];
            PartyAccount::create([
                'party_id' => $request->orderData['supplier_party_id'],
                'amount' =>  $request->orderData['airline_payable'],
                'balance' => $new_balance,
                'payment_type' => $creditPayment->payment_type_id,
                'payment_method_id' => 0,
                'system_remarks' => 'airline_order',
                'description' => "Credit transaction added",
                'payment_date' => Carbon::createFromFormat('d-m-Y', $request->orderData['order_completion_date'])->format('Y-m-d'),
                'order_id' =>  $airlineOrder->id,
                'outlet_id' => session('outlet_id'),
                'created_by' => session('employee_id'),
            ]);

            // customer party debit transaction    
            $customer_party_balance = PartyAccount::where('party_id', $request->orderData['customer_party_id'])->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
            $customer_party_balance = $customer_party_balance ?? 0;

            $new_balance = $customer_party_balance - $request->orderData['total_recievable'];
            PartyAccount::create([
                'party_id' => $request->orderData['customer_party_id'],
                'amount' =>  $request->orderData['total_recievable'],
                'balance' => $new_balance,
                'payment_type' => $debitPayment->payment_type_id,
                'payment_method_id' => $request->orderData['payment_method_id'] ?? $payment->payment_method_id,
                'system_remarks' => 'airline_order',
                'description' => "Debit transaction added",
                'payment_date' => Carbon::createFromFormat('d-m-Y', $request->orderData['order_completion_date'])->format('Y-m-d'),
                'order_id' =>  $airlineOrder->id,
                'outlet_id' => session('outlet_id'),
                'created_by' => session('employee_id'),
            ]);


            ///if customer pay
            if ($payment->payment_value == 0) {

                //customer party transaction
                $customer_party_balance = PartyAccount::where('party_id', $request->orderData['customer_party_id'])->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
                $customer_party_balance = $customer_party_balance ?? 0;

                $new_balance = $customer_party_balance + $request->orderData['total_recievable'];
                PartyAccount::create([
                    'party_id' => $request->orderData['customer_party_id'],
                    'amount' =>  $request->orderData['total_recievable'],
                    'balance' => $new_balance,
                    'payment_type' => $creditPayment->payment_type_id,
                    'payment_method_id' => $request->orderData['payment_method_id'],
                    'system_remarks' => 'airline_order',
                    'description' => "Credit transaction added",
                    'payment_date' => Carbon::createFromFormat('d-m-Y', $request->orderData['order_completion_date'])->format('Y-m-d'),
                    'order_id' =>  $airlineOrder->id,
                    'outlet_id' => session('outlet_id'),
                    'created_by' => session('employee_id'),
                ]);

                // Outlet payment
                $balance = OutletPaymentTransaction::where('payment_method_id', $request->orderData['payment_method_id'])->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
                $new_balance = $balance + $request->orderData['total_recievable'];

                OutletPaymentTransaction::create([
                    'amount'  => $request->orderData['total_recievable'],
                    'balance'  =>  $new_balance,
                    'transaction_type'  => 'debit',
                    'system_remarks'  => 'airline_order',
                    'description'  => "Debit transaction added",
                    'payment_date'  => Carbon::createFromFormat('d-m-Y', $request->orderData['order_completion_date'])->format('Y-m-d'),
                    'payment_method_id'  => $request->orderData['payment_method_id'],
                    'order_id' => $airlineOrder->id,
                    'customer_id' => $request->orderData['customer_party_id'],
                    'supplier_id' => $request->orderData['supplier_party_id'],
                    'outlet_id' => session('outlet_id'),
                    'created_by' => session('employee_id'),
                ]);
            }
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $airline_order = AirlineOrder::with("airline_tickets", "discount_details", "commission_details")
            ->leftJoin('parties as customer_party', 'customer_party.id', 'airline_orders.customer_party_id')
            ->leftJoin('categories', 'categories.id', 'airline_orders.category_id')
            ->leftJoin('parties as supplier_party', 'supplier_party.id', 'airline_orders.supplier_party_id')
            ->leftJoin('payment_types', 'payment_types.id', 'airline_orders.payment_type_id')
            ->leftJoin('payment_methods', 'payment_methods.id', 'airline_orders.payment_method_id')
            ->where('airline_orders.id', $id)
            ->select(
                'airline_orders.*',
                'customer_party.party_title as customer_party_title',
                'categories.category_title',
                'supplier_party.party_title as supplier_party_title',
                'payment_types.title as payment_type_title',
                'payment_methods.payment_title as payment_method_title',
            )
            ->firstOrFail();

        $payment_types = PaymentType::where('payment_types.outlet_id', session('outlet_id'))
            ->orderBy('payment_types.title', 'asc')->get();

        $payment_methods = PaymentMethod::where('payment_methods.outlet_id', session('outlet_id'))
            ->join('payment_types', 'payment_types.id', 'payment_methods.payment_type_id')
            ->where('payment_types.value', 0)
            ->orderBy('payment_methods.payment_title', 'asc')
            ->select('payment_methods.*')
            ->get();
        $taxes = OutletTax::where('tax_status', 'active')->where('outlet_id', session('outlet_id'))->latest()->get();
        $commissions = OutletCommission::where('commission_status', 'active')->where('outlet_id', session('outlet_id'))->latest()->get();
        $discounts = OutletDiscount::where('discount_status', 'active')->where('outlet_id', session('outlet_id'))->latest()->get();

        return view('pages.airlines.orders.edit_order.edit', compact('airline_order', 'payment_methods', 'payment_types', 'taxes', 'commissions', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
