<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AddPurchaseOrders extends Component
{   
    public $supplier_id;
    public $notification=[];
    public $supplier_title;
    public $outlet_id;
    public $created_by;
    public $companies;
    public $payment_methods;
    public $suppliers;
    public $orderProducts = [];
    public $allProducts = [];
    public $purchase_order=[];
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
        'purchase_order.po_number' => 'required',
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
        'purchase_order.po_number.required' => 'Reference No. is required.',
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
        $this->suppliers = Supplier::where('outlet_id', session('outlet_id'))->latest()->pluck('supplier_title', 'id');
        $this->payment_methods = DB::table('payment_methods')->pluck('payment_title', 'id');
        $this->po_request_date = Carbon::today()->format('Y-m-d');
        $this->purchase_order=[
            'supplier_id' => '',
            'po_number' => '',
            'po_request_date' => '',
            'po_expected_date' => '',
            'po_purchased_date' => '',
            'po_status' => '',
            'payment_type' => '',
            'payment_method_id' => '',
            'po_discount_value' => 0,
            'po_discount_percentage' => 0,
            'total_bill' => '',
            'amount_payable' => '',
            'remarks' => '',
            'created_by' => '',
            'outlet_id' => '',
        ];     
        $this->orderProducts = [
            [
                'product_id' => '',
                'old_cost' => 0,
                'new_cost' => 0,
                'requested_quantity' => 0,
                'purchased_quantity' => 0,
                'discount_value' => '',
                'discount_percentage' => '',
                'item_total' => 0,
                'remarks' => '',
                'created_by' => $this->created_by,
                'outlet_id' => $this->outlet_id,
            ]
        ];
    }


   
    public function getProducts($value)
    {
        $this->supplier_id=$value;
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
        if($value != ''){
            $this->orderProducts[$index]['old_cost'] = DB::table('product_stocks')->where('product_id', $value)->pluck('cost_price')->first();
            $this->orderProducts[$index]['new_cost'] = DB::table('product_stocks')->where('product_id', $value)->pluck('cost_price')->first();
            $this->calculateData('none');
        }
        else{
            $this->orderProducts[$index]=
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

                if ($data == 'status' && $this->purchase_order['po_status'] != 'delivered') {
                    $this->purchase_order['po_purchased_date'] = '';
                }
                if ($orderProducts['product_id'] != '') {
                    $subTotal = 0;
                    $finalTotal = 0;

                    if ($this->purchase_order['po_status'] == 'delivered' && $orderProducts['purchased_quantity'] != 0 && $orderProducts['new_cost'] != 0) {
                        $subTotal = $orderProducts['new_cost'] * $orderProducts['purchased_quantity'];
                    } else if ($this->purchase_order['po_status'] != 'delivered' && $orderProducts['requested_quantity'] != 0 && $orderProducts['old_cost'] != 0) {
                        $subTotal = $orderProducts['old_cost'] * $orderProducts['requested_quantity'];
                        // dd($subTotal);
                    }

                    
                        if (($orderProducts['discount_value'] || $orderProducts['discount_percentage']) != 0 && $subTotal !=0) {
                            $disPer = ($orderProducts['discount_value'] / $subTotal) * 100;
                            if ($data == 'dis_val' && $disPer > 0) {
                                $orderProducts['discount_percentage'] = round($disPer, 2);
                            } 
                        }
                    

                        if (($orderProducts['discount_value'] || $orderProducts['discount_percentage']) != 0) {
                            $disVal = ($orderProducts['discount_percentage'] * $subTotal) / 100;
                            if ($data == 'dis_per' && $disVal > 0) {
                                if ($disVal > 0) {
                                    $orderProducts['discount_value'] = round($disVal, 2);
                                } 
                            }
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
        if ($this->total_bill!=0) {
            if ($data == 'percentage') {
                $disVal = ($this->purchase_order['po_discount_percentage'] * $this->total_bill) / 100;
                $this->purchase_order['po_discount_value'] = round($disVal, 2);
            }
            else {
                $disPer = ($this->purchase_order['po_discount_value'] / $this->total_bill) * 100;
                $this->purchase_order['po_discount_percentage'] = round($disPer, 2);
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
        
        $this->validate();
        if($this->purchase_order['po_status']=='delivered'){
            $this->validate([
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
            ]);
        }

        DB::transaction(
            function(){
                $po=InventoryPurchaseOrder::create($this->purchase_order);
                
                for($index=0; $index < count($this->orderProducts); $index++){
                    $po_detail = new InventoryPurchaseOrderDetail([
                        'inventory_purchase_order_id' => $po->id,
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
            });
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
        if(count($this->orderProducts) > 1){
            unset($this->orderProducts[$index]);
            $this->orderProducts = array_values($this->orderProducts);
        }
    }

    public function render()
    {
        $this->outlet_id = session('outlet_id');
        $this->created_by= Auth::user()->id;
        $this->total_bill = 0;
        for ($i = 0; $i < count($this->orderProducts); $i++) {
            $this->total_bill += $this->orderProducts[$i]['item_total'];
        }
        $this->amount_payable = round($this->total_bill - $this->purchase_order['po_discount_value'], 2);
        $this->purchase_order['total_bill']=$this->total_bill;
        $this->purchase_order['amount_payable']=$this->amount_payable;
        $this->purchase_order['outlet_id']=$this->outlet_id;
        $this->purchase_order['created_by']=$this->created_by;

        return view('livewire.add-purchase-orders');
    }
}
