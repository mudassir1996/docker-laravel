<?php

namespace App\Http\Controllers;

use App\Classes\Subscriber;
use App\Models\Company;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Supplier;
use App\Models\SupplierAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductStockController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('product_stock_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('stock_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }


        $product_stocks = DB::table('product_stocks')
            ->select('product_stocks.*', 'outlets.outlet_title', 'employees.employee_name', 'products.product_title')
            ->leftJoin('products', 'product_stocks.product_id', '=', 'products.id')
            ->leftJoin('outlets', 'product_stocks.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'product_stocks.created_by', '=', 'employees.id')
            ->where('product_stocks.outlet_id', session('outlet_id'))
            ->orderBy('product_stocks.id', 'desc')
            ->get();

        return view('pages.product.product_stock.product_stock', compact('product_stocks'));
    }



    public function create()
    {
        $product_id = session('product_id') ?? '';
        $suppliers = Supplier::where('outlet_id', session('outlet_id'))->latest()->pluck('supplier_title', 'id');
        $companies = Company::where('outlet_id', session('outlet_id'))->latest()->pluck('company_title', 'id');
        $products = Product::leftJoin('companies', 'products.company_id', 'companies.id')->where('products.outlet_id', session('outlet_id'))->orderBy('products.id', 'desc')->select('products.product_title', 'products.product_allow_half', 'products.id', 'companies.company_title')->get();
        $payment_types = DB::table('payment_types')->where('outlet_id', session('outlet_id'))->get();
        return view('pages.product.product_stock.add_stock', compact('product_id', 'suppliers', 'companies', 'products', 'payment_types'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $units_in_stock = ProductStock::where('product_id', $request->product_id)->pluck('units_in_stock')->first();

            ProductStock::where('product_id', $request->product_id)
                ->update([
                    'cost_price' => $request->cost_price,
                    'retail_price' => $request->retail_price,
                    'units_in_stock' => $units_in_stock + $request->units_in_stock,
                    'outlet_id' => $request->outlet_id,
                    'created_by' => $request->created_by,
                ]);

            if (Subscriber::isPremium()) {
                $purchase_order = InventoryPurchaseOrder::create([
                    'supplier_id' => $request->supplier_id,
                    'po_number' => 0,
                    'po_request_date' => $request->po_purchased_date,
                    'po_expected_date' => $request->po_purchased_date,
                    'po_purchased_date' => $request->po_purchased_date,
                    'po_status' => 'delivered',
                    'payment_type' => $request->payment_type,
                    'payment_method_id' => $request->payment_method_id,
                    'total_bill' => $request->total_bill,
                    'amount_payable' => $request->total_bill,
                    'remarks' => $request->remarks ?? "Added from add stock form",
                    'outlet_id' => $request->outlet_id,
                    'created_by' => $request->created_by,
                ]);

                InventoryPurchaseOrderDetail::create([
                    'inventory_purchase_order_id' => $purchase_order->id,
                    'product_id' => $request->product_id,
                    'old_cost_price' => $request->cost_price,
                    'new_cost_price' => $request->cost_price,
                    'requested_quantity' => $request->units_in_stock,
                    'purchased_quantity' => $request->units_in_stock,
                    'item_total' => $request->total_bill,
                    'remarks' => "Added through add stock form.",
                    'outlet_id' => $request->outlet_id,
                    'created_by' => $request->created_by,
                ]);
            }


            $payment_type = DB::table('payment_types')->where('outlet_id', session('outlet_id'))->where('id', $request->payment_type)->first();

            if ($payment_type->value == 0) {
                $transaction_request = new Request([
                    'amount'  => abs($request->total_bill),
                    'payment_type' => $payment_type,
                    'payment_method_id'  => $request->payment_method_id,
                    'payment_date'  => Carbon::now(),
                    'system_remarks' => 'add_stock',
                    'description' => "Transaction added from add stock",
                    'order_id' => Subscriber::isPremium() ? $purchase_order->id : '',
                    'supplier_id' => $request->supplier_id,
                ]);

                $outlet_payment_transaction = new OutletPaymentTransactionController();
                $outlet_payment_transaction->insert($transaction_request);
            } else if ($payment_type->value == 1) {
                $balance = SupplierAccount::where('supplier_id', $request->supplier_id)->latest()->pluck('balance')->first();
                $balance = $balance ?? 0;

                $payment_type_id = DB::table('payment_types')
                    ->where('outlet_id', session('outlet_id'))
                    ->where('value', 0)
                    ->pluck('id')
                    ->first();
                $supplier_transaction = new SupplierAccount(
                    [
                        'amount'  => abs($request->total_bill),
                        'balance'  => $balance + abs($request->total_bill),
                        'payment_type'  => $payment_type_id,
                        'description'  => 'Credit purchase order transaction created from add stock page.',
                        'payment_date'  => Carbon::now(),
                        'payment_method_id'  => $request->payment_method_id,
                        'order_id' => Subscriber::isPremium() ? $purchase_order->id : '',
                        'supplier_id' => $request->supplier_id,
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]
                );

                $supplier_transaction->save();
            }
        });

        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Product stock added successfully!',
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

        return redirect()->route('product-stock.index')->with($notification);
    }

    public function create_old_stock()
    {
        $product_id = session('product_id') ?? '';
        $products = Product::where('products.outlet_id', session('outlet_id'))->orderBy('products.id', 'desc')->select('products.product_title', 'products.product_allow_half', 'products.id')->get();
        return view('pages.product.product_stock.add_old_stock', compact('product_id', 'products'));
    }

    public function store_old_stock(Request $request)
    {
        DB::transaction(function () use ($request) {
            $units_in_stock = ProductStock::where('product_id', $request->product_id)->pluck('units_in_stock')->first();

            ProductStock::where('product_id', $request->product_id)
                ->update([
                    'cost_price' => $request->cost_price,
                    'retail_price' => $request->retail_price,
                    'units_in_stock' => $units_in_stock + $request->units_in_stock,
                    'outlet_id' => $request->outlet_id,
                    'created_by' => $request->created_by,
                ]);
        });

        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Product stock added successfully!',
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

        return redirect()->route('product-stock.index')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('product_stock_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('stock_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $product_stock = ProductStock::select('product_stocks.*', 'outlets.outlet_title', 'users.username', 'products.product_title')
            ->leftJoin('products', 'product_stocks.product_id', '=', 'products.id')
            ->leftJoin('outlets', 'product_stocks.outlet_id', '=', 'outlets.id')
            ->leftJoin('users', 'product_stocks.created_by', '=', 'users.id')
            ->where('product_stocks.id', $id)
            ->where('product_stocks.outlet_id', session('outlet_id'))
            ->firstOrFail();

        return view('pages.product.product_stock.edit_stock', compact('product_stock'));
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

        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('stock_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $request->validate(
            [
                'retail_price' => 'required|numeric',
            ],
            [
                'retail_price.required' => 'Retail price is required',
            ]
        );

        $product_stock = ProductStock::where('product_stocks.id', $id)
            ->where('product_stocks.outlet_id', session('outlet_id'))
            ->firstOrFail();

        $product_stock->retail_price = $request->get('retail_price');
        $product_stock->stock_keeping = $request->get('stock_keeping') ?? 0;
        $product_stock->minimum_threshold = $request->get('minimum_threshold');
        $product_stock->outlet_id = $request->outlet_id;
        $product_stock->created_by = $request->created_by;




        if ($product_stock->save()) {
            $notification = array(
                'message' => 'Changes Saved!',
                'alert-type' => 'success'
            );
        }
        //setting up succes message
        else {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect('outlets/product-stock')->with($notification);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function low_stock(Request $request)
    {
        abort_if(Gate::denies('product_stock_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('stock_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $suppliers = Supplier::select('supplier_title', 'id')->where('outlet_id', session('outlet_id'))->get();
        $companies = Company::select('company_title', 'id')->where('outlet_id', session('outlet_id'))->get();

        $product_stocks = ProductStock::getLowStock()
            ->leftJoin('products', 'product_stocks.product_id', '=', 'products.id')
            ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
            ->leftJoin('outlets', 'product_stocks.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'product_stocks.created_by', '=', 'employees.id')
            ->select('product_stocks.*', 'outlets.outlet_title', 'employees.employee_name', 'products.product_title', 'companies.company_title')
            ->where('product_stocks.outlet_id', session('outlet_id'))
            ->orderBy('product_stocks.id', 'desc')
            ->get();
        return view('pages.product.product_stock.low_stock', compact('product_stocks', 'suppliers', 'companies'));
    }

    public function edit_stock()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $products = Product::where('products.outlet_id', session('outlet_id'))
            ->join('product_stocks', 'product_stocks.product_id', 'products.id')
            ->where('product_stocks.stock_keeping', 1)
            ->orderBy('products.id', 'desc')
            ->select('products.product_title', 'products.product_allow_half', 'products.id')
            ->get();
        // $suppliers = Supplier::where('outlet_id', session('outlet_id'))->latest()->pluck('supplier_title', 'id');
        return view('pages.product.product_stock.update_stock', compact('products'));
    }



    public function update_stock(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'product_id' => 'required',
            'po_status' => 'required',
            'units_in_stock' => 'required',
        ]);

        $product_data = ProductStock::where('product_id', $request->product_id)->where('outlet_id', session('outlet_id'))->firstOrFail();

        if ($request->po_status != 'invalid-entry') {
            $total_bill = $product_data->cost_price * -abs($request->units_in_stock);
            $units = $request->units_in_stock;
            $supplier_id = $request->supplier_id ?? 0;
        } else if ($request->po_status == 'return-to-supplier') {
            $total_bill = 0;
        } else {
            $total_bill = 0;
            $supplier_id = 0;
            $units = $request->units_in_stock;
        }


        DB::transaction(
            function () use ($request, $product_data, $total_bill, $units, $supplier_id) {
                //select payment type Debit
                $payment = DB::table('payment_types')->where('payment_types.outlet_id', session('outlet_id'))
                    ->where('payment_types.value', 0)
                    ->join('payment_methods', 'payment_methods.id', 'payment_types.id')
                    ->select('payment_types.id as payment_type_id', 'payment_methods.id as payment_method_id')
                    ->first();

                $purchase_order = new InventoryPurchaseOrder([
                    'supplier_id' => $supplier_id,
                    'po_number' => 0,
                    'po_request_date' => Carbon::now(),
                    'po_expected_date' => Carbon::now(),
                    'po_purchased_date' => Carbon::now(),
                    'po_status' => $request->po_status,
                    'payment_type' => $payment->payment_type_id,
                    'payment_method_id' => $payment->payment_method_id,
                    'total_bill' => $total_bill,
                    'amount_payable' => $total_bill,
                    'po_discount_value' => 0,
                    'po_discount_percentage' => 0,
                    'remarks' => $request->remarks,
                    'outlet_id' => session('outlet_id'),
                    'created_by' => session('employee_id'),
                ]);

                $purchase_order->save();

                $purchase_order_detail = new InventoryPurchaseOrderDetail([
                    'inventory_purchase_order_id' => $purchase_order->id,
                    'product_id' => $request->product_id,
                    'old_cost_price' => abs($product_data->cost_price),
                    'new_cost_price' => abs($product_data->cost_price),
                    'requested_quantity' => $units,
                    'purchased_quantity' => $units,
                    'discount_value' => 0,
                    'discount_percentage' => 0,
                    'item_total' => $total_bill,
                    'remarks' => $request->remarks,
                    'outlet_id' => session('outlet_id'),
                    'created_by' => session('employee_id'),
                ]);

                $purchase_order_detail->save();

                ProductStock::where('product_id', $request->product_id)
                    ->update([
                        'units_in_stock' => $product_data->units_in_stock + $units,
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]);
            }
        );


        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Stock updated successfully!',
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
        if ($request->po_status == 'return-to-supplier') {
            return redirect()->route('purchase-orders.supplier-return')->with($notification);
        } else {
            return redirect()->route('purchase-orders.other')->with($notification);
        }


        // $products = Product::where('outlet_id', session('outlet_id'))->latest()->select('product_title', 'product_allow_half', 'id')->get();
        // return view('pages.product.product_stock.update_stock', compact('products'));
    }
}
