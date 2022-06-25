<div>
    <form wire:submit.prevent="add_purchase_order_to_db" enctype="multipart/form-data">
        <!--begin::Card-->
        <div class="card card-custom mb-8">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <h3 class="card-label">Add Purchase Order
                        <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Accounts</span> -->
                    </h3>
                </div>
            </div>
            <div class="card-body py-0">
                <!--begin::Form-->

                @csrf
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-xl-3">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Supplier</label>
                                <div wire:ignore class="input-group">
                                    <select class="form-control supplier_select" data-live-search="true" wire:model="purchase_order.supplier_id" id="supplier" title="Select Supplier" data-size="5" wire:change="getProducts($event.target.value)">
                                        @foreach($suppliers as $id => $supplier)
                                        <option value="{{$id}}">{{$supplier}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#supplier_model">
                                            Add
                                        </button>
                                    </div>
                                </div>
                                @error('purchase_order.supplier_id')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Reference No</label>{{$purchase_order['po_number']}}
                                <input type="text" class="form-control @error('purchase_order.po_number') is-invalid @enderror" wire:model.lazy="purchase_order.po_number" placeholder="Reference No" />
                                @error('purchase_order.po_number')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Request Date</label>
                                <input type="text" class="form-control flatpickr @error('purchase_order.po_request_date') is-invalid @enderror" wire:model="purchase_order.po_request_date" placeholder="Select Date" readonly />
                                @error('purchase_order.po_request_date')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Expected Date</label>
                                <input type="text" class="form-control flatpickr @error('purchase_order.po_expected_date') is-invalid @enderror" id="" placeholder="Select Date" wire:model="purchase_order.po_expected_date" readonly />
                                @error('purchase_order.po_expected_date')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <!--end::Input-->
                        </div>

                        <div class="col-xl-3">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Purchased Date</label>
                                <input type="text" class="form-control flatpickr @error('purchase_order.po_purchased_date') is-invalid @enderror" {{$purchase_order['po_status']=='delivered'?'':'disabled'}} placeholder="Select Date" wire:model="purchase_order.po_purchased_date" readonly />
                                @error('purchase_order.po_purchased_date')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <!--end::Input-->
                        </div>

                        <div class="col-xl-3">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>PO Status</label>
                                <select class="form-control" wire:change="calculateData('status')" wire:model="purchase_order.po_status">
                                    <option value="">--choose status--</option>
                                    <option value="requested">Requested</option>
                                    <option value="in-process">In-Process</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                </select>
                                @error('purchase_order.po_status')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Payment Type</label>
                                <select class="form-control" wire:model="purchase_order.payment_type">
                                    <option value="">--choose payment type--</option>
                                    <option value="credit">Credit</option>
                                    <option value="debit">Debit</option>
                                </select>
                                @error('purchase_order.payment_type')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Payment Method</label>
                                <select class="form-control" wire:model="purchase_order.payment_method_id">
                                    <option value="">--choose payment method--</option>
                                    @foreach($payment_methods as $id => $payment_method)
                                    <option value="{{$id}}">{{$payment_method}}</option>
                                    @endforeach
                                </select>
                                @error('purchase_order.payment_method_id')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <!--end::Input-->
                        </div>

                    </div>

                </div>
            </div>


        </div>
        <!--end::Card-->
        <!--begin::Card-->
        <div class="card card-custom mb-8">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <h3 class="card-label">Order Details
                        <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Accounts</span> -->
                    </h3>
                </div>
                <div class="card-toolbar">
                    <button class="btn btn-success font-weight-bolder" wire:click.prevent="addProduct">Add Product</button>
                    <button class="btn btn-dark font-weight-bolder ml-2 px-10" wire:click.prevent="clearForm">Clear</button>
                    <!-- <a class="btn btn-sm btn-success" wire:click.prevent="addProduct">Add Product</a> -->
                </div>
            </div>

            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table nowrap" id="item_table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Old Cost</th>
                            @if($purchase_order['po_status']=='delivered')
                            <th scope="col">New Cost</th>
                            @endif
                            <th scope="col">Requested Qty</th>
                            @if($purchase_order['po_status']=='delivered')
                            <th scope="col">Purchased Qty</th>
                            @endif
                            <th scope="col">Discount Value</th>
                            <th scope="col">Discount %</th>
                            <th scope="col">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orderProducts as $index => $orderProduct)
                        <tr>
                            <td class="align-middle">
                                {{$index+1}}
                            </td>
                            <td>
                                <select name="orderProducts[{{$index}}][product_id]" wire:change="getProductOldCost($event.target.value,{{$index}})" wire:model="orderProducts.{{$index}}.product_id" data-size="5" data-live-search="true" class="form-control @error('orderProducts.'.$index.'.product_id') is-invalid @enderror">
                                    <option value="">-- choose product --</option>
                                    @foreach ($allProducts as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->product_title }}
                                    </option>
                                    @endforeach
                                </select>

                            </td>
                            <td>
                                <input type="number" min="0" step="0.01" name="orderProducts[{{$index}}][old_cost]" disabled class="form-control @error('orderProducts.'.$index.'.old_cost') is-invalid @enderror" wire:model="orderProducts.{{$index}}.old_cost" />
                            </td>

                            @if($purchase_order['po_status']=='delivered')
                            <td>
                                <input type="number" min="0" step="0.01" name="orderProducts[{{$index}}][new_cost]" class="form-control @error('orderProducts.{{$index}}.new_cost') is-invalid @enderror" wire:change="calculateData('none')" wire:model="orderProducts.{{$index}}.new_cost" />
                            </td>
                            @endif
                            <td>
                                <input type="number" min="0" step="0.01" name="orderProducts[{{$index}}][requested_quantity]" class="form-control @error('orderProducts.'.$index.'.requested_quantity') is-invalid @enderror" wire:model.lazy="orderProducts.{{$index}}.requested_quantity" wire:change="calculateData('none')" />
                            </td>
                            @if($purchase_order['po_status']=='delivered')
                            <td>
                                <input type="number" min="0" step="0.01" name="orderProducts[{{$index}}][purchased_quantity]" class="form-control @error('orderProducts.'.$index.'.purchased_quantity') is-invalid @enderror" wire:model.lazy="orderProducts.{{$index}}.purchased_quantity" wire:change="calculateData('none')" />
                            </td>
                            @endif
                            <td>
                                <input type="number" min="0" step="0.01" name="orderProducts[{{$index}}][discount_value]" wire:change="calculateData('dis_val')" class="form-control" wire:model.lazy="orderProducts.{{$index}}.discount_value" />
                            </td>
                            <td>
                                <input type="number" min="0" step="0.01" name="orderProducts[{{$index}}][discount_percentage]" wire:change="calculateData('dis_per')" class="form-control" wire:model.lazy="orderProducts.{{$index}}.discount_percentage" />
                            </td>
                            <td>
                                <input type="number" min="0" step="0.01" name="orderProducts[{{$index}}][item_total]" disabled class="form-control" wire:model="orderProducts.{{$index}}.item_total" />
                            </td>
                            <td class="align-middle">
                                <a href="#" class="remove" wire:click.prevent="{{count($orderProducts) > 1?'removeProduct('.$index.')':''}}">
                                    <i class="fas fa-window-close font-size-h3 text-danger text-focus-primary"></i>
                                </a>
                            </td>
                        <tr>
                            <td style="border-top:0px;"></td>
                            <td colspan="{{$purchase_order['po_status']=='delivered'?'8':'6'}}" style="border-top:0px;">
                                <input type="text" class="form-control form-control-solid" wire:model="orderProducts.{{$index}}.remarks" placeholder="Remarks">
                            </td>
                            <td style="border-top:0px;"></td>
                        </tr>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>

            <div class="card-footer">
                <div class="row justify-content-between px-8 px-md-0">
                    <div class="col-md-8">
                        <div class=" font-size-lg">
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <textarea class="form-control" wire:model="purchase_order.remarks" name="remarks" id="remarks" rows="7"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end flex-column flex-md-row font-size-lg">
                            <div class="d-flex flex-column mb-10 mb-md-0 w-100 bg-whitesmoke rounded">
                                <div class="py-5 px-4">
                                    <div class="d-flex justify-content-between py-4 ">
                                        <span class="font-weight-bold">Total Bill:</span>
                                        <!-- <input type="hidden" name="total_bill" id="total_bill"> -->
                                        <span class="text-right font-weight-bolder">
                                            <span>{{$total_bill}}</span>
                                        </span>
                                    </div>


                                    <div class="d-flex justify-content-between py-3">
                                        <span class="mr-5 pt-2 font-weight-bold">Discount Value:</span>
                                        <span class="text-right">
                                            <input type="number" step="0.01" value="{{$purchase_order['po_discount_value']}}" class="form-control form-control-sm" wire:model.lazy="purchase_order.po_discount_value" wire:change="mainDiscount('value')" placeholder="Discount Amount" />
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between py-3">
                                        <span class="mr-5 pt-2 font-weight-bold">Discount %:</span>
                                        <span class="text-right">
                                            <input type="number" step="0.01" value="{{$purchase_order['po_discount_percentage']}}" class="form-control form-control-sm" wire:model.lazy="purchase_order.po_discount_percentage" wire:change="mainDiscount('percentage')" placeholder="Discount Percentage" />
                                        </span>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between align-items-center rounded-bottom px-4 py-5 bg-dark text-light">
                                    <span class="font-weight-bold ">Payable Amount:</span>
                                    <span class="text-right font-weight-bolder">
                                        <span class="display-4" id="payable_amount">{{$amount_payable}}</span>
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row justify-content-end">
                    <div class="col-xl-2">
                        <button type="submit" class="btn btn-primary btn-shadow px-12">Submit Order</button>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Card-->
    </form>

    @livewire('add-supplier')

</div>