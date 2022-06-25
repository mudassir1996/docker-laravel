<?php

namespace App\Http\Livewire;

use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Supplier;
use App\Models\SupplierAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditPurchaseOrder extends Component
{
    public $purchase_order_id;
    public $supplier_id;
    public $notification = [];
    public $supplier_title;
    public $outlet_id;
    public $created_by;
    public $companies;
    public $payment_methods;
    public $suppliers;
    public $orderProducts = [];
    public $allProducts = [];
    public $purchase_order = [];
    public $po_status;
    public $po_number;
    public $po_request_date;
    public $po_expected_date;
    public $po_purchased_date;
    public $payment_type;
    public $payment_method_id;
    public $item_total;
    public $po_discount_value;
    public $po_discount_percentage;
    public $total_bill;
    public $amount_payable;

    protected $rules = [
        'purchase_order.supplier_id' => 'required',
        'purchase_order.po_request_date' => 'required',
        'purchase_order.po_expected_date' => 'required',
        'purchase_order.po_status' => 'required',
        'purchase_order.payment_type' => 'required',
        'purchase_order.payment_method_id' => 'required',
        'orderProducts.*.product_id' => 'required',
        'orderProducts.*.old_cost' => 'required',
        'orderProducts.*.requested_quantity' => 'required|gt:0',
    ];

    protected $messages =  [
        'purchase_order.supplier_id.required' => 'Please select a supplier.',
        'purchase_order.po_request_date.required' => 'Please select requested date.',
        'purchase_order.po_expected_date.required' => 'Please select expected date.',
        'purchase_order.po_status.required' => 'Please select a status',
        'purchase_order.payment_type.required' => 'Please select a payment type',
        'purchase_order.payment_method_id.required' => 'Please select a payment method',
        'orderProducts.*.product_id.required' => 'Please select a product',
        'orderProducts.*.old_cost.required' => 'Old cost is required',
        'orderProducts.*.requested_quantity.required' => 'Please enter requested quantity',
        'orderProducts.*.requested_quantity.gt' => 'Quantity must be greater than 0',
    ];


    public function mount()
    {
        $this->purchase_order_id = request()->segment(3);

        // $this->suppliers = Supplier::where('outlet_id', session('outlet_id'))->pluck('supplier_title', 'id');
        $this->payment_type = DB::table('payment_types')->where('outlet_id', session('outlet_id'))->pluck('title as payment_type_title', 'id');
        $this->payment_methods = collect();
        $get_purchase_order = InventoryPurchaseOrder::with('purchase_order_details')->where('inventory_purchase_orders.id', $this->purchase_order_id)
            ->leftJoin('suppliers', 'suppliers.id', 'inventory_purchase_orders.supplier_id')
            ->leftJoin('inventory_purchase_order_details', 'inventory_purchase_order_details.inventory_purchase_order_id', 'inventory_purchase_orders.id')
            ->select('inventory_purchase_orders.*', 'suppliers.supplier_title')
            ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->first();

        if ($get_purchase_order == null) {
            return redirect()->route('purchase-orders.index');
        }

        $this->supplier_title = $get_purchase_order->supplier_title;

        $this->payment_methods = DB::table('payment_methods')->where('payment_type_id', $get_purchase_order->payment_type)->pluck('payment_title', 'id');
        $this->purchase_order = [
            'supplier_id' => $get_purchase_order->supplier_id,
            'po_number' => $get_purchase_order->po_number,
            'po_request_date' => $get_purchase_order->po_request_date,
            'po_expected_date' => $get_purchase_order->po_expected_date,
            'po_purchased_date' => ($get_purchase_order->po_purchased_date == '0000-00-00') ? '' : $get_purchase_order->po_purchased_date,
            'po_status' => $get_purchase_order->po_status,
            'payment_type' => $get_purchase_order->payment_type,
            'payment_method_id' => $get_purchase_order->payment_method_id,
            'po_discount_value' => $get_purchase_order->po_discount_value ?? 0,
            'po_discount_percentage' => $get_purchase_order->po_discount_percentage ?? 0,
            'total_bill' => $get_purchase_order->total_bill,
            'amount_payable' => $get_purchase_order->amount_payable,
            'remarks' => $get_purchase_order->remarks,
            'created_by' => $get_purchase_order->created_by,
            'outlet_id' => $get_purchase_order->outlet_id,
        ];

        // dd($this->purchase_order['po_purchased_date']);

        $supplier_selected = Supplier::with(['company'])->where('id', $get_purchase_order->supplier_id)->first();

        $companies = $supplier_selected->company()->pluck('companies.id');

        $this->allProducts = Product::whereIn('products.company_id', $companies)
            ->leftJoin('product_stocks', 'products.id', '=', 'product_stocks.product_id')
            ->select('products.id', 'products.product_title', 'product_stocks.units_in_stock', 'product_stocks.minimum_threshold')
            ->orderBy('product_stocks.units_in_stock', 'asc')
            ->get();

        foreach ($get_purchase_order->purchase_order_details as $purchase_order_detail) {
            // dd($purchase_order_detail->old_cost_price);
            $this->orderProducts[] =
                [
                    'product_id' => $purchase_order_detail->product_id,
                    'old_cost' => $purchase_order_detail->old_cost_price,
                    'new_cost' => $purchase_order_detail->new_cost_price,
                    'requested_quantity' => $purchase_order_detail->requested_quantity,
                    'purchased_quantity' => $purchase_order_detail->purchased_quantity,
                    'discount_value' => $purchase_order_detail->discount_value ?? 0,
                    'discount_percentage' => $purchase_order_detail->discount_percentage ?? 0,
                    'item_total' => $purchase_order_detail->item_total,
                    'remarks' => $purchase_order_detail->remarks,
                    'created_by' => $this->created_by,
                    'outlet_id' => $this->outlet_id,
                ];
        }
        // dd($this->orderProducts);

    }



    public function getProducts($value)
    {
        $this->supplier_id = $value;
        // dd($value);
        $supplier_selected = Supplier::with(['company'])->where('id', $value)->first();
        $companies = $supplier_selected->company()->pluck('companies.id');
        $this->allProducts = Product::whereIn('products.company_id', $companies)
            ->leftJoin('product_stocks', 'products.id', '=', 'product_stocks.product_id')
            ->select('products.id', 'products.product_title', 'product_stocks.units_in_stock', 'product_stocks.minimum_threshold')
            ->orderBy('product_stocks.units_in_stock', 'asc')
            ->get();

        $this->orderProducts = [
            [
                'product_id' => '',
                'old_cost' => 0,
                'new_cost' => 0,
                'requested_quantity' => 0,
                'purchased_quantity' => 0,
                'discount_value' => 0,
                'discount_percentage' => 0,
                'item_total' => 0,
                'remarks' => '',
            ]
        ];
    }

    public function getProductOldCost($value, $index)
    {
        if ($value != '') {
            $this->orderProducts[$index]['old_cost'] = DB::table('product_stocks')->where('product_id', $value)->pluck('cost_price')->first();
            $this->orderProducts[$index]['new_cost'] = DB::table('product_stocks')->where('product_id', $value)->pluck('cost_price')->first();
            $this->calculateData('none');
        } else {
            $this->orderProducts[$index] =
                [
                    'product_id' => '',
                    'old_cost' => 0,
                    'new_cost' => 0,
                    'requested_quantity' => 0,
                    'purchased_quantity' => 0,
                    'discount_value' => 0,
                    'discount_percentage' => 0,
                    'item_total' => 0,
                    'remarks' => '',
                ];
        }
    }

    public function calculateData($data)
    {
        $this->orderProducts = collect($this->orderProducts)
            ->map(function ($orderProducts) use ($data) {
                $orderProducts['new_cost'] = abs($orderProducts['new_cost']);
                $orderProducts['purchased_quantity'] = abs($orderProducts['purchased_quantity']);
                $orderProducts['old_cost'] = abs($orderProducts['old_cost']);
                $orderProducts['requested_quantity'] = abs($orderProducts['requested_quantity']);
                $orderProducts['discount_value'] = abs($orderProducts['discount_value']);
                $orderProducts['discount_percentage'] = abs($orderProducts['discount_percentage']);



                if ($data == 'status' && $this->purchase_order['po_status'] != 'delivered') {
                    $this->purchase_order['po_purchased_date'] = '';
                    $orderProducts['purchased_quantity'] = 0;
                    $orderProducts['discount_value'] = 0;
                    $orderProducts['discount_percentage'] = 0;
                }


                if ($orderProducts['product_id'] != '') {
                    $subTotal = 0;
                    $finalTotal = 0;

                    if ($this->purchase_order['po_status'] == 'delivered' && $orderProducts['purchased_quantity'] != 0 && $orderProducts['new_cost'] != 0) {
                        $subTotal = abs($orderProducts['new_cost']) * abs($orderProducts['purchased_quantity']);
                    } else if ($this->purchase_order['po_status'] != 'delivered' && $orderProducts['requested_quantity'] != 0 && $orderProducts['old_cost'] != 0) {
                        $subTotal = abs($orderProducts['old_cost']) * abs($orderProducts['requested_quantity']);
                    }



                    if (($orderProducts['discount_value'] || $orderProducts['discount_percentage']) != 0 && $subTotal != 0) {
                        $disPer = ($orderProducts['discount_value'] / $subTotal) * 100;
                        if ($data == 'dis_val') {
                            $orderProducts['discount_percentage'] = round($disPer, 2);
                        }
                    }


                    if ($orderProducts['discount_percentage'] != 0) {
                        $disVal = ($orderProducts['discount_percentage'] * $subTotal) / 100;
                        if ($data == 'dis_per') {
                            if ($disVal > 0) {
                                $orderProducts['discount_value'] = round($disVal, 2);
                            }
                        }
                    } else {
                        $orderProducts['discount_value'] = 0;
                        $orderProducts['discount_percentage'] = 0;
                    }

                    if ($orderProducts['discount_percentage'] > 100) {
                        $orderProducts['discount_value'] = 0;
                        $orderProducts['discount_percentage'] = 0;
                    }

                    $finalTotal = $subTotal - $orderProducts['discount_value'];
                    $orderProducts['item_total'] = round($finalTotal, 2);
                    $this->mainDiscount('');
                }
                return $orderProducts;
            })->toArray();
    }
    public function mainDiscount($data)
    {
        // dd($data);

        $this->purchase_order['po_discount_percentage'] = abs($this->purchase_order['po_discount_percentage']);
        $this->purchase_order['po_discount_value'] = abs($this->purchase_order['po_discount_value']);
        if ($this->total_bill != 0) {
            if ($data == 'percentage') {
                if ($this->purchase_order['po_discount_percentage'] <= 100) {
                    $disVal = ($this->purchase_order['po_discount_percentage'] * $this->total_bill) / 100;
                    $this->purchase_order['po_discount_value'] = round($disVal, 2);
                } else {
                    $this->purchase_order['po_discount_percentage'] = 0;
                    $this->purchase_order['po_discount_value'] = 0;
                }
            } else {
                if ($this->purchase_order['po_discount_value'] <= $this->total_bill) {
                    $disPer = ($this->purchase_order['po_discount_value'] / $this->total_bill) * 100;
                    $this->purchase_order['po_discount_percentage'] = round($disPer, 2);
                } else {
                    $this->purchase_order['po_discount_percentage'] = 0;
                    $this->purchase_order['po_discount_value'] = 0;
                }
            }
        } else {
            // $this->emit('alert', ['type' => 'error', 'message' => 'Discount cannot be added.']);
            $this->purchase_order['po_discount_percentage'] = 0;
            $this->purchase_order['po_discount_value'] = 0;
        }
    }

    public function addProduct()
    {
        $this->orderProducts[] = [
            'product_id' => '',
            'old_cost' => 0,
            'new_cost' => 0,
            'requested_quantity' => 0,
            'purchased_quantity' => 0,
            'discount_value' => 0,
            'discount_percentage' => 0,
            'item_total' => 0,
            'remarks' => '',
        ];
    }
    public function add_purchase_order_to_db()
    {
        // dd($this->purchase_order['po_status']);
        $this->validate();
        if ($this->purchase_order['po_status'] == 'delivered') {
            $this->validate(
                [
                    'purchase_order.po_purchased_date' => 'required',
                    'orderProducts.*.purchased_quantity' => 'required|gt:0',
                    'orderProducts.*.new_cost' => 'required|gt:0',
                ],
                [
                    'purchase_order.po_purchased_date.required' => 'Please select purchased date.',
                    'orderProducts.*.purchased_quantity.required' => 'Please enter purchased quantity.',
                    'orderProducts.*.purchased_quantity.gt' => 'Quantity must be greater than 0.',
                    'orderProducts.*.new_cost.required' => 'Please enter new cost price.',
                    'orderProducts.*.new_cost.gt' => 'New cost price must be greater than 0.',
                ]
            );
        }

        DB::transaction(
            function () {
                $payment_type = DB::table('payment_types')
                    ->where('outlet_id', session('outlet_id'))
                    ->where('id', $this->purchase_order['payment_type'])
                    ->select('value')
                    ->first();
                $po = InventoryPurchaseOrder::where('id', $this->purchase_order_id)->update($this->purchase_order);

                InventoryPurchaseOrderDetail::where('inventory_purchase_order_id', $this->purchase_order_id)->delete();
                for ($index = 0; $index < count($this->orderProducts); $index++) {
                    $po_detail = InventoryPurchaseOrderDetail::firstOrNew([
                        'inventory_purchase_order_id' => $this->purchase_order_id,
                        'product_id' => $this->orderProducts[$index]['product_id'],
                        'old_cost_price' => $this->orderProducts[$index]['old_cost'],
                        'new_cost_price' => $this->orderProducts[$index]['new_cost'],
                        'requested_quantity' => $this->orderProducts[$index]['requested_quantity'],
                        'purchased_quantity' => $this->orderProducts[$index]['purchased_quantity'],
                        'item_total' => $this->orderProducts[$index]['item_total'],
                        'discount_value' => $this->orderProducts[$index]['discount_value'],
                        'discount_percentage' => $this->orderProducts[$index]['discount_percentage'],
                        'remarks' => $this->orderProducts[$index]['remarks'],
                        'outlet_id' => $this->outlet_id,
                        'created_by' => $this->created_by,
                    ]);

                    $units_in_stock = ProductStock::where('product_id', $this->orderProducts[$index]['product_id'])->pluck('units_in_stock')->first();

                    if ($this->purchase_order['po_status'] == 'delivered') {
                        ProductStock::where('product_id', $this->orderProducts[$index]['product_id'])->update([
                            'cost_price' => $this->orderProducts[$index]['new_cost'],
                            'units_in_stock' => $units_in_stock + $this->orderProducts[$index]['purchased_quantity'],
                        ]);
                    }

                    $po_detail->save();
                }

                if ($this->purchase_order['po_status'] == 'delivered' && $payment_type->value == '1') {
                    $balance = SupplierAccount::where('supplier_id', $this->purchase_order['supplier_id'])->latest()->pluck('balance')->first();
                    $balance = $balance ?? 0;

                    $payment_type_id = DB::table('payment_types')
                        ->where('outlet_id', session('outlet_id'))
                        ->where('value', 0)
                        ->pluck('id')
                        ->first();

                    $supplier_transaction = new SupplierAccount(
                        [
                            'amount'  => abs($this->purchase_order['amount_payable']),
                            'balance'  => $balance + abs($this->purchase_order['amount_payable']),
                            'payment_type'  => $payment_type_id,
                            'description'  => 'Credit purchase order transaction created from Purchase Orders.',
                            'payment_date'  => Carbon::now(),
                            'payment_method_id'  => $this->purchase_order['payment_method_id'],
                            'order_id' => $this->purchase_order_id,
                            'supplier_id' =>  $this->purchase_order['supplier_id'],
                            'outlet_id' => session('outlet_id'),
                            'created_by' => session('employee_id'),
                        ]
                    );

                    $supplier_transaction->save();
                }
            }
        );
        // if (DB::transactionLevel() == 0) {
        // $this->dispatchBrowserEvent('success');
        // } else {
        //     $this->dispatchBrowserEvent('error');
        // }
        if (DB::transactionLevel() == 0) {
            return redirect()->route('purchase-orders.index');
        } else {
            $this->emit('alert', ['type' => 'error', 'message' => 'Something went wrong.']);
        }
        // /return redirect(route('purchase-orders.create'));
        // return redirect('outlets/purchase-orders')->with($notification);



    }

    public function clearForm()
    {
        $this->purchase_order['po_discount_value'] = 0;
        $this->purchase_order['po_discount_percentage'] = 0;
        $this->orderProducts = [
            [
                'product_id' => '',
                'old_cost' => 0,
                'new_cost' => 0,
                'requested_quantity' => 0,
                'purchased_quantity' => 0,
                'discount_value' => 0,
                'discount_percentage' => 0,
                'item_total' => 0,
                'remarks' => '',
            ]
        ];
    }
    public function removeProduct($index)
    {
        if (count($this->orderProducts) > 1) {
            unset($this->orderProducts[$index]);
            $this->orderProducts = array_values($this->orderProducts);
        }
    }

    public function getPaymentMethod($id)
    {
        $this->payment_methods = DB::table('payment_methods')->where('payment_type_id', $id)->pluck('payment_title', 'id');
        // $this->payment_methods = $payment_methods;
    }

    public function render()
    {
        $this->outlet_id = session('outlet_id');
        $this->created_by = session('employee_id');
        $this->total_bill = 0;
        for ($i = 0; $i < count($this->orderProducts); $i++) {
            $this->total_bill += $this->orderProducts[$i]['item_total'];
        }
        $this->amount_payable = round($this->total_bill - $this->purchase_order['po_discount_value'], 2);
        $this->purchase_order['total_bill'] = $this->total_bill;
        $this->purchase_order['amount_payable'] = $this->amount_payable;
        $this->purchase_order['outlet_id'] = $this->outlet_id;
        $this->purchase_order['created_by'] = $this->created_by;

        return view('livewire.edit-purchase-order');
    }
}
