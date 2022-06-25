<?php

namespace App\Http\Controllers;

use App\Classes\Sms;
use App\Classes\Subscriber;
use App\Models\Category;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\LvMessageLog;
use App\Models\Outlet;
use App\Models\OutletPaymentTransaction;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesOrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SalesOrderController extends Controller
{


    /**
     * Display a sales screen.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('sales_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('sales_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $customers = Customer::where('outlet_id', session('outlet_id'))->orderBy('id', 'asc')->select('id', 'customer_name', 'allow_credit')->get();
        // dd($customers);
        $payment_methods = DB::table('payment_methods')->where('outlet_id', session('outlet_id'))->get();
        $payment_types = DB::table('payment_types')->where('outlet_id', session('outlet_id'))->get();
        $sales_orders = SalesOrder::with('sales_order_detail')
            ->leftJoin('customers', 'sales_orders.customer_id', '=', 'customers.id')
            ->select('sales_orders.*',  'customers.customer_name')
            ->where('sales_orders.so_status', 'completed')
            ->where('sales_orders.outlet_id', session('outlet_id'))
            ->orderByDesc('sales_orders.created_at')
            ->get();

        if (Gate::allows('sales_screen')) {
            return view('pages.sales.main_sales', compact('customers', 'sales_orders', 'payment_methods', 'payment_types'));
        } elseif (Gate::allows('sales_screen_limited_products')) {
            $products = DB::table('products')
                ->join('product_stocks', 'products.id', '=', 'product_stocks.product_id')
                ->select('products.*', 'product_stocks.retail_price as retail_price', 'product_stocks.units_in_stock')
                ->where('products.outlet_id', session('outlet_id'))->orderBy('id', 'desc')->get();

            $categories = Category::where('outlet_id', session('outlet_id'))->get();

            return view('pages.sales.limitted_products_sales', compact('customers',  'categories', 'payment_methods', 'payment_types', 'products'));
        }
    }



    /**
     * storing sales screen data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('sales_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $order_id = 0;
        DB::transaction(function () use ($request, &$order_id) {
            $oldOrderDetails = collect();
            $oldBill = SalesOrder::where('id', $request->order_id)->pluck('amount_payable')->first();
            $sales_order = SalesOrder::updateOrCreate(
                ['id' => $request->order_id],
                [
                    'customer_id' => $request->customer_id,
                    'total_bill' => $request->total_bill ?? 0,
                    'so_discount_value' => $request->so_discount_value ?? 0,
                    'so_discount_percentage' => $request->so_discount_percentage ?? 0,
                    'so_tax_value' => $request->so_tax_value ?? 0,
                    'so_tax_percentage' => $request->so_tax_percentage ?? 0,
                    'amount_payable' => $request->grand_total ?? 0,
                    'amount_paid' => $request->amount_paid ?? 0,
                    'change_back' => $request->change_back ?? 0,
                    'profit_percentage' => $request->profit_percentage ?? 0,
                    'profit_value' => $request->profit_value ?? 0,
                    'so_status' => $request->so_status,
                    'payment_type' => $request->payment_type,
                    'payment_method_id' => $request->payment_method_id,
                    'remarks' => $request->remarks,
                    'order_completion_date' => Carbon::now(),
                    'processing_person_id' => session('employee_id'),
                    'outlet_id' => session('outlet_id'),
                    'created_by' => session('employee_id'),
                ]
            );
            $order_id = $sales_order->id;
            if ($request->order_type == 'edit_order') {
                $oldOrderDetails = SalesOrderDetail::where('sales_order_id', $request->order_id)
                    ->get();

                $oldOrderProducts = $oldOrderDetails->map(function ($item) {
                    return $item->product_id;
                });
                $oldOrderProducts = $oldOrderProducts->toArray();
                $deletedProducts = array_diff($oldOrderProducts, $request->product_id);
                SalesOrderDetail::where('sales_order_id', $sales_order->id)
                    ->whereIn('product_id', $deletedProducts)
                    ->delete();
                foreach ($deletedProducts as $deletedProduct) {
                    $product_stock = ProductStock::where('product_id', $deletedProduct)->select('stock_keeping', 'units_in_stock')->first();

                    $units_in_stock = $product_stock->units_in_stock;
                    $stock_keeping = $product_stock->stock_keeping;

                    if ($stock_keeping == 1) {
                        $oldOrderDetail = $oldOrderDetails->firstWhere('product_id', $deletedProduct);
                        ProductStock::where('product_id', $deletedProduct)->update([
                            'units_in_stock' => $units_in_stock + $oldOrderDetail->quantity,
                        ]);
                    }
                }
            }


            for ($count = 0; $count < count($request->product_id); $count++) {
                if ($request->order_type == 'edit_order' || $request->order_type == 'hold_order') {
                    SalesOrderDetail::where('sales_order_id', $sales_order->id)
                        ->where('product_id', $request->product_id[$count])
                        ->delete();
                }
                // $items += $request->quantity[$count];
                $sales_order_details = SalesOrderDetail::firstOrNew(
                    [
                        'sales_order_id' => $sales_order->id,
                        'product_id' => $request->product_id[$count],
                        'cost_price' => $request->cost_price[$count] ?? 0,
                        'retail_price' => $request->retail_price[$count] ?? 0,
                        'quantity' => $request->quantity[$count] ?? 0,
                        'total_cost' => $request->total_cost[$count] ?? 0,
                        'total_retail' => $request->total_retail[$count] ?? 0,
                        'discount_value' => $request->discount_value[$count] ?? 0,
                        'discount_percentage' => $request->discount_percentage[$count] ?? 0,
                        'tax_value' => $request->tax_value[$count] ?? 0,
                        'tax_percentage' => $request->tax_percentage[$count] ?? 0,
                        'amount_payable' => $request->amount_payable[$count] ?? 0,
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]
                );

                if ($request->so_status == 'completed') {
                    $product_stock = ProductStock::where('product_id', $request->product_id[$count])->select('stock_keeping', 'units_in_stock')->first();

                    $units_in_stock = $product_stock->units_in_stock;
                    $stock_keeping = $product_stock->stock_keeping;

                    if ($stock_keeping == 1) {
                        if (empty($request->order_id) || $request->order_type == 'hold_order') {
                            ProductStock::where('product_id', $request->product_id[$count])->update([
                                'units_in_stock' => $units_in_stock - $request->quantity[$count],
                            ]);
                        } else {
                            $oldData = $oldOrderDetails->firstWhere('product_id', $request->product_id[$count]);
                            $oldQuantity = 0;
                            if ($oldData) {
                                $oldQuantity = $oldData->quantity;
                            }
                            $newQuantity = $request->quantity[$count];
                            $quantity = $newQuantity - $oldQuantity;
                            // dd($quantity);

                            ProductStock::where('product_id', $request->product_id[$count])->update([
                                'units_in_stock' => $units_in_stock - $quantity,
                            ]);
                        }
                    }
                }
                $sales_order_details->save();
            }

            if ($request->send_sms_invoice && $request->so_status == 'completed') {
                $customer_phone = Customer::where('id', $request->customer_id)->where('outlet_id', session('outlet_id'))->pluck('customer_phone')->first();
                $outlet_title = Outlet::where('id', session('outlet_id'))->pluck('outlet_title')->first();
                if ($customer_phone) {
                    $items = array_sum($request->quantity);
                    $msg = "Thanks you for shopping at " . $outlet_title . ". You have purchased " . $items . " items in PKR " . $request->amount_paid . ".";
                    $api = 'fastsmsalerts';
                    $sms = new Sms();
                    $sms->send($customer_phone, $msg, $api);
                    LvMessageLog::create([
                        'from' => env('SHORT_CODE'),
                        'to' => $customer_phone,
                        'body' => $msg,
                        'status' => 'system-generated',
                        'user_type' => 'employee',
                        'created_by' => session('employee_id')
                    ]);
                }
            }



            $returnProducts = array_filter($request->quantity, function ($x) {
                return $x < 0;
            });

            if (count($returnProducts) > 0) {
                $keys = array_keys($returnProducts);
                $total_bill = 0;
                $total_discount_value = 0;
                $total_discount_percentage = 0;

                for ($i = 0; $i < count($keys); $i++) {

                    $total_bill += abs($request->total_retail[$keys[$i]]);
                    $total_discount_value += abs($request->discount_value[$keys[$i]]);
                    $total_discount_percentage += abs($request->discount_percentage[$keys[$i]]);
                }

                // dd($total_bill);

                $purchase_order = InventoryPurchaseOrder::create([
                    'supplier_id' => 0,
                    'po_number' => 0,
                    'po_request_date' => Carbon::now(),
                    'po_expected_date' => Carbon::now(),
                    'po_purchased_date' => Carbon::now(),
                    'po_status' => 'returned',
                    'payment_type' => $request->payment_type,
                    'payment_method_id' => $request->payment_method_id,
                    'total_bill' => $total_bill,
                    'amount_payable' => $total_bill,
                    'po_discount_value' => $total_discount_value,
                    'po_discount_percentage' => $total_discount_percentage,
                    'remarks' => "Return order",
                    'outlet_id' => session('outlet_id'),
                    'created_by' => session('employee_id'),
                ]);

                for ($i = 0; $i < count($keys); $i++) {
                    $product_id = $request->product_id[$keys[$i]];


                    InventoryPurchaseOrderDetail::create([
                        'inventory_purchase_order_id' => $purchase_order->id,
                        'product_id' => $product_id,
                        'old_cost_price' => abs($request->retail_price[$keys[$i]]),
                        'new_cost_price' => abs($request->retail_price[$keys[$i]]),
                        'requested_quantity' => abs($request->quantity[$keys[$i]]),
                        'purchased_quantity' => abs($request->quantity[$keys[$i]]),
                        'discount_value' => $request->discount_value[$keys[$i]],
                        'discount_percentage' => $request->discount_percentage[$keys[$i]],
                        'item_total' => abs($request->total_retail[$keys[$i]]),
                        'remarks' => "Return order",
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]);

                    // $units_in_stock = ProductStock::where('product_id', $product_id)->pluck('units_in_stock')->first();

                    // ProductStock::where('product_id', $product_id)
                    //     ->where('stock_keeping', 1)
                    //     ->update([
                    //         'units_in_stock' => $units_in_stock + $request->quantity[$keys[$i]],
                    //         'created_by' => session('employee_id'),
                    //     ]);
                }
            }

            $payment_type = DB::table('payment_types')->where('id', $request->payment_type)->first();

            if (($request->so_status == 'completed' && $payment_type->value == 0) && ($request->customer_id != 0)) {

                if ($request->order_type == 'edit_order') {
                    $balance = OutletPaymentTransaction::where('order_id', $sales_order->id)->where('payment_method_id', $request->payment_method_id)->where('outlet_id', session('outlet_id'))->latest()->pluck('balance')->first();
                    $balance = $balance ?? 0;
                    // $oldBill = SalesOrder::where('id', $sales_order->id)->pluck('amount_payable')->first();
                    $newBill = $request->grand_total;
                    $finalBill = $newBill - $oldBill;
                    // dd($oldBill);
                    if ($finalBill < 0) {
                        $transaction_type = 'credit';
                        $new_balance = $balance + $finalBill;
                        // dd($new_balance);
                    } else if ($finalBill > 0) {
                        $transaction_type = 'debit';
                        $new_balance = $balance + $finalBill;
                        // dd($new_balance);
                    }
                    OutletPaymentTransaction::create([
                        'amount'  => $finalBill,
                        'balance'  =>  $new_balance,
                        'transaction_type'  => $transaction_type,
                        'system_remarks'  => 'sales_orders',
                        'description'  => 'Transaction added on edited sales order',
                        'payment_date'  => Carbon::now(),
                        'payment_method_id'  => $request->payment_method_id,
                        'order_id' => $sales_order->id,
                        'customer_id' => $request->customer_id ?? 0,
                        'supplier_id' => $request->supplier_id ?? 0,
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]);
                } else {
                    $transaction_request = new Request([
                        'amount'  => $request->grand_total,
                        'payment_type' => $payment_type,
                        'payment_method_id'  => $request->payment_method_id,
                        'payment_date'  => Carbon::now(),
                        'system_remarks' => 'sales_orders',
                        'description' => "Transaction added on debit sale",
                        'order_id' => $sales_order->id,
                        'customer_id' => $request->customer_id,
                    ]);


                    $outlet_payment_transaction = new  OutletPaymentTransactionController();
                    $outlet_payment_transaction->insert($transaction_request);
                }
            } else if (($request->so_status == 'completed' && $payment_type->value == 1) && ($request->customer_id != 0)) {
                $balance = CustomerAccount::where('customer_id', $request->customer_id)->latest()->pluck('balance')->first();
                $balance = $balance ?? 0;


                $customer_transaction = new CustomerAccount(
                    [
                        'amount'  => $request->grand_total,
                        'balance'  => $balance - $request->grand_total,
                        'payment_type'  => $request->payment_type,
                        'description'  => 'Credit order has been placed',
                        'payment_date'  => Carbon::now(),
                        'payment_method_id'  => $request->payment_method_id,
                        'order_id' => $sales_order->id,
                        'customer_id' => $request->customer_id,
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]
                );

                $customer_transaction->save();
            } else if (($request->so_status == 'completed' && $payment_type->value == 2) && ($request->customer_id != 0)) {
                $balance = CustomerAccount::where('customer_id', $request->customer_id)->latest()->pluck('balance')->first();
                $balance = $balance ?? 0;
                if ($request->change_back < 0) {
                    $payment_type = DB::table('payment_types')->where('outlet_id', session('outlet_id'))->where('value', 1)->first();
                    $payment_method = DB::table('payment_methods')->where('payment_type_id', $payment_type->id)->first();
                    $customer_transaction = new CustomerAccount(
                        [
                            'amount'  => abs($request->change_back),
                            'balance'  => $balance - abs($request->change_back),
                            'payment_type'  => $payment_type->id,
                            'description'  => 'Split order has been placed',
                            'payment_date'  => Carbon::now(),
                            'payment_method_id'  => $payment_method->id,
                            'order_id' => $sales_order->id,
                            'customer_id' => $request->customer_id,
                            'outlet_id' => session('outlet_id'),
                            'created_by' => session('employee_id'),
                        ]
                    );

                    $customer_transaction->save();
                } else if ($request->change_back > 0 && $request->change_to_customer_account) {
                    $payment_type = DB::table('payment_types')->where('value', 0)->first();
                    $payment_method = DB::table('payment_methods')->where('payment_type_id', $payment_type->id)->first();
                    $customer_transaction = new CustomerAccount(
                        [
                            'amount'  => $request->change_back,
                            'balance'  => $balance + $request->change_back,
                            'payment_type'  => $payment_type->id,
                            'description'  => 'Change back from split order',
                            'payment_date'  => Carbon::now(),
                            'payment_method_id'  => $payment_method->id,
                            'order_id' => $sales_order->id,
                            'customer_id' => $request->customer_id,
                            'outlet_id' => session('outlet_id'),
                            'created_by' => session('employee_id'),
                        ]
                    );

                    $customer_transaction->save();
                }
            }
        });
        $remarks_print = '';
        $request->remarks_print == 'on' ? $remarks_print = '?remarks_print=' . $request->remarks_print : '';
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Sales order added',
                'alert-type' => 'success',
                'url' => 'gen-invoice/' . $order_id . $remarks_print

            );
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error',
            );
        }

        return back()->with($notification);
    }


    public function sales_orders()
    {
        abort_if(Gate::denies('sales_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('sales_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $sales_orders = DB::table('sales_orders')
            ->select('sales_orders.*', 'customers.customer_name', 'payment_methods.payment_title', 'payment_types.title as payment_type_title', 'outlets.outlet_title', 'employees.employee_name')
            ->join('customers', 'sales_orders.customer_id', '=', 'customers.id')
            ->leftJoin('outlets', 'sales_orders.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'sales_orders.created_by', '=', 'employees.id')
            ->leftJoin('payment_methods', 'sales_orders.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'sales_orders.payment_type', '=', 'payment_types.id')
            ->where('sales_orders.outlet_id', session('outlet_id'))
            ->orderByDesc('sales_orders.created_at')
            ->get();

        $customers = Customer::where('outlet_id', session('outlet_id'))->pluck('customer_name', 'id');
        $payment_types = PaymentType::where('outlet_id', session('outlet_id'))->get();
        $categories = Category::where('outlet_id', session('outlet_id'))->pluck('category_title', 'id');

        return view('pages.sales.sales_orders', compact('sales_orders', 'customers', 'categories', 'payment_types'));
    }


    public function filter(Request $request)
    {
        abort_if(Gate::denies('sales_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('sales_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $sales_orders = SalesOrder::filter()
            ->join('customers', 'sales_orders.customer_id', '=', 'customers.id')
            ->join('outlets', 'sales_orders.outlet_id', '=', 'outlets.id')
            ->join('employees', 'sales_orders.created_by', '=', 'employees.id')
            ->join('sales_order_details', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
            ->join('products', 'sales_order_details.product_id', 'products.id')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('payment_methods', 'sales_orders.payment_method_id', '=', 'payment_methods.id')
            ->join('payment_types', 'sales_orders.payment_type', '=', 'payment_types.id')
            ->select(
                'sales_orders.*',
                'customers.customer_name',
                'payment_methods.payment_title',
                'outlets.outlet_title',
                'employees.employee_name',
                'payment_types.title as payment_type_title',
            )
            ->where('sales_orders.outlet_id', session('outlet_id'))
            ->orderByDesc('sales_orders.created_at')
            ->get();

        $customers = Customer::where('outlet_id', session('outlet_id'))->pluck('customer_name', 'id');
        $categories = Category::where('outlet_id', session('outlet_id'))->pluck('category_title', 'id');
        $payment_types = PaymentType::where('outlet_id', session('outlet_id'))->get();


        return view('pages.sales.sales_orders', compact('sales_orders', 'customers', 'categories', 'payment_types'));
    }


    public function show_order_details(Request $request)
    {
        abort_if(Gate::denies('sales_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('sales_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $id = $request->id;
        $sales_order = SalesOrder::select('sales_orders.*', 'customers.id as customer_id', 'customers.customer_name', 'customers.customer_phone', 'payment_methods.payment_title', 'outlets.outlet_title', 'outlets.outlet_feature_img', 'outlets.outlet_address', 'outlets.outlet_phone', 'outlets.outlet_slogan', 'users.username')
            ->leftJoin('customers', 'sales_orders.customer_id', '=', 'customers.id')
            ->leftJoin('outlets', 'sales_orders.outlet_id', '=', 'outlets.id')
            ->leftJoin('users', 'sales_orders.created_by', '=', 'users.id')
            ->leftJoin('payment_methods', 'sales_orders.payment_method_id', '=', 'payment_methods.id')
            ->where('sales_orders.id', $id)
            ->where('sales_orders.outlet_id', session('outlet_id'))
            ->firstOrFail();

        $balance = CustomerAccount::where('customer_id', $sales_order->customer_id)->latest()->pluck('balance')->first();
        // dd($sales_order);
        $order_details = DB::table('sales_order_details')
            ->select('sales_order_details.quantity', 'sales_order_details.retail_price', 'sales_order_details.discount_value', 'sales_order_details.amount_payable', 'products.product_title')
            ->leftJoin('products', 'sales_order_details.product_id', '=', 'products.id')
            ->where('sales_order_id', $id)
            ->get();

        return view('pages.sales.order_details', compact('balance', 'sales_order', 'order_details'));
        // dd($sales_order->outlet_title);
    }

    public function get_hold_orders(Request $request)
    {
        // return $request->all();

        if (Subscriber::isPremium()) {
            $hold_orders = SalesOrder::with('sales_order_detail')
                ->leftJoin('customers', 'customers.id', 'sales_orders.customer_id')
                ->where('sales_orders.so_status', 'on-hold')
                ->where('sales_orders.outlet_id', session('outlet_id'))
                ->orderByDesc('sales_orders.created_at')
                ->select('sales_orders.*', 'customers.id as customer_id', 'customers.customer_name')
                ->get();
        } else {
            $customer = Customer::where('outlet_id', session('outlet_id'))->orderBy('id', 'asc')->select('id')->first();
            $hold_orders = SalesOrder::with('sales_order_detail')->where('sales_orders.customer_id', $customer->id)
                ->leftJoin('customers', 'customers.id', 'sales_orders.customer_id')
                ->where('sales_orders.so_status', 'on-hold')
                ->where('sales_orders.outlet_id', session('outlet_id'))
                ->orderByDesc('sales_orders.created_at')
                ->select('sales_orders.*', 'customers.id as customer_id', 'customers.customer_name')
                ->get();
        }

        // $hold_orders = SalesOrder::with('sales_order_detail')->where('customer_id', $request->customer_id)
        //     ->where('so_status', 'on-hold')
        //     ->where('outlet_id', session('outlet_id'))
        //     ->orderByDesc('created_at')
        //     ->get();


        $output = '';
        foreach ($hold_orders as $id => $hold_order) {

            $output .= '<tr>' .
                '<td class="font-weight-bolder align-middle">' . $hold_order->id . '</td>' .
                '<td class="font-weight-bolder align-middle">' . $hold_order->customer_name . '</td>' .
                '<td class="font-weight-bolder align-middle">' . $hold_order->order_completion_date . '</td>' .
                '<td class="font-weight-bolder align-middle">' . $hold_order->amount_payable . '</td>' .
                '<td class="font-weight-bolder row align-middle">' .
                '<a href="#" onclick="select_hold_order(' . $id . ')" class="btn font-weight-bolder btn-sm btn-outline-primary mr-2 px-4">Import</a>' .
                '<form method="post" id="delete_item_form' . $hold_order->id . '" action="' . route("hold-order.destroy", $hold_order->id) . '">' .
                '<input type="hidden" name="_token" value="' . csrf_token() . '">' .
                '<input type="hidden" name="_method" value="DELETE">' .
                '<a class="btn font-weight-bolder btn-sm btn-outline-primary mr-2 px-4" title="Delete" type="submit"' .
                'onclick="deleteConfirmation(delete_item_form' . $hold_order->id . ')">' .
                'Delete</a>' .
                '</form>' .
                '</td>' .
                '</tr>';
        }

        $data['output'] = $output;
        $data['hold_orders'] = $hold_orders;

        return response($data);
    }

    public function delete_hold_order($id)
    {
        $hold_order = SalesOrder::where('id', $id)
            ->where('so_status', 'on-hold')
            ->where('outlet_id', session('outlet_id'))->firstOrFail();

        if ($hold_order->delete()) {
            $notification = array(
                'message' => 'Order Deleted!',
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
        return back()->with($notification);
    }

    public function get_orders(Request $request)
    {
        if ($request->ajax()) {
            $order = SalesOrder::with('sales_order_detail')->where('sales_orders.id', $request->order_id)
                ->leftJoin('customers', 'sales_orders.customer_id', '=', 'customers.id')
                ->select('sales_orders.*',  'customers.customer_name')
                ->where('sales_orders.so_status', 'completed')
                ->where('sales_orders.outlet_id', session('outlet_id'))
                ->orderByDesc('sales_orders.created_at')
                ->first();


            $output = '<tr>' .
                '<td class="font-weight-bolder">' . $order->id . '</td>' .
                '<td class="font-weight-bolder">' . date('d-m-Y h:i A', strtotime($order->order_completion_date)) . '</td>' .
                '<td class="font-weight-bolder">' . $order->amount_payable . '</td>' .
                '<td class="font-weight-bolder">' .
                '<a href="#" onclick="select_return_order(' . json_encode($order) . ')" class="btn font-weight-bolder btn-sm btn-outline-primary mr-2">Edit</a>' .
                '</td>' .
                '</tr>';

            $data['output'] = $output;
            // $data['orders'] = $order;

            return response($data);
        }
    }

    public function get_product_data(Request $request)
    {

        $product_data = Product::where('products.id', $request->product_id)
            ->leftJoin('product_stocks', 'product_stocks.product_id', '=', 'products.id')
            ->select('products.product_title', 'products.product_feature_img', 'product_stocks.stock_keeping', 'product_stocks.retail_price', 'product_stocks.cost_price', 'product_stocks.units_in_stock', 'product_stocks.minimum_threshold')
            ->first();

        return response($product_data);
    }
}
