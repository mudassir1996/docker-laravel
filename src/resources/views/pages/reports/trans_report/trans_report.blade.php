@extends('layout.default')
@section('title', 'Customer Report')
@section('content')



<div class="row">
    <div class="col-xl-12 mb-6">
        <div class="card">
            <form action="{{route('transaction-report.filter')}}" method="get">
                @csrf
                <div class="card-header p-4 d-flex flex-column">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Filter</a>
                </div>
                <div class="card-body d-flex flex-column p-4">
                    <div class="form-group row mb-1">
                        <div class="col-xl-2">
                            <div class="form-group mb-0">
                                <label for="">From Date</label>
                                <input type="text" id="kt_datepicker_3" readonly value="{{(request()->from_date!='')?request()->from_date:''}}" class="form-control form-control-sm" name="from_date" placeholder="Select Date">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group mb-0">
                                <label for="">To Date</label>
                                <input type="text" id="kt_datepicker_3" readonly value="{{(request()->to_date!='')?request()->to_date:''}}" class="form-control form-control-sm" name="to_date" placeholder="Select Date">
                            </div>
                        </div>


                        <div class="col-xl-2">
                            <div class="form-group mb-0">
                                <label for="">Customer</label>
                                <select name="customer_id" class="form-control form-control-sm" id="">
                                    <option value="">Nothing Selected</option>
                                    <option value="0" {{(request()->customer_id=='0')?'selected':''}}>Walk-in Customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" {{(request()->customer_id==$customer->id)?'selected':''}}>{{$customer->customer_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group mb-0">
                                <label for="">Supplier</label>
                                <select name="supplier_id" class="form-control form-control-sm" id="">
                                    <option value="">Nothing Selected</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{$supplier->id}}" {{(request()->supplier_id==$supplier->id)?'selected':''}}>{{$supplier->supplier_title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group mb-0">
                                <label for="">Payment Type</label>
                                <select name="payment_type" class="form-control form-control-sm" id="">
                                    <option value="">Nothing Selected</option>
                                    <option value="debit" {{(request()->payment_type=='debit')?'selected':''}}>Debit</option>
                                    <option value="credit" {{(request()->payment_type=='credit')?'selected':''}}>Credit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2 mt-2">
                            <div class="form-group mb-0">
                                <label for="">Minimum Bill</label>
                                <input type="number" value="{{(request()->min_total!='')?request()->min_total:''}}" class="form-control form-control-sm" name="min_total" placeholder="Minimum Total">
                            </div>
                        </div>
                        <div class="col-xl-2 mt-2">
                            <div class="form-group mb-0">
                                <label for="">Maximum Bill</label>
                                <input type="number" value="{{(request()->max_total!='')?request()->max_total:''}}" class="form-control form-control-sm" name="max_total" placeholder="Maximum Total">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-shadow mt-8 col-1" type="submit">Search</button>
                </div>
               
            </form>
        </div>
    </div>




    <div class="col-xl-6">
        <div class="card">
            <div class="card-body d-flex flex-column p-2">
                <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                    <div class="d-flex flex-column mr-2">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Sales Transactions</a>
                        <span class="text-muted font-weight-bold mt-2">Sales from {{$fromDate}} to {{$toDate}}</span>
                    </div>
                </div>
                <div id="my-scroll" style="overflow-y:scroll; height:260px;">
                    <table class="table nowrap ">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Total Bill</th>
                                <th>Transaction Type</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sales_transactions as $sales_transaction)
                            <tr>
                                <td>{{$sales_transaction->id}}</td>
                                <td>{{$sales_transaction->customer_name??'Walk-in Client'}}</td>
                                <td>{{$sales_transaction->amount_payable}}</td>
                                <td>{{$sales_transaction->payment_type}}</td>
                                <td>{{$sales_transaction->order_completion_date}}</td>
                                <td>
                                    <a href="{{route('sales-orders', $sales_transaction->id)}}">
                                        <button class="btn btn-success btn-sm">View</button>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan=6>No Records</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body d-flex flex-column p-2">
                <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                    <div class="d-flex flex-column mr-2">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Purchase Transactions</a>
                        <span class="text-muted font-weight-bold mt-2">Purchases from {{$fromDate}} to {{$toDate}}</span>
                    </div>
                </div>
                <div id="my-scroll" style="overflow-y:scroll; height:260px;">
                    <table class="table nowrap ">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Supplier</th>
                                <th>Total Bill</th>
                                <th>Transaction Type</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($purchase_transactions as $purchase_transaction)
                            <tr>
                                <td>{{$purchase_transaction->id}}</td>
                                <td>{{$purchase_transaction->supplier_title}}</td>
                                <td>{{$purchase_transaction->amount_payable}}</td>
                                <td>{{$purchase_transaction->payment_type}}</td>
                                <td>{{$purchase_transaction->po_purchased_date}}</td>
                                <td>
                                    <a href="{{route('purchase-orders.show', $purchase_transaction->id)}}">
                                        <button class="btn btn-success btn-sm">View</button>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan=6>No Records</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 mt-6">
        <div class="card">
            <div class="card-body d-flex flex-column p-2">
                <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                    <div class="d-flex flex-column mr-2">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Customer Transactions</a>
                        <span class="text-muted font-weight-bold mt-2">Transactions from {{$fromDate}} to {{$toDate}}</span>
                    </div>
                </div>
                <div id="my-scroll" style="overflow-y:scroll; height:260px;">
                    <table class="table nowrap ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Total Bill</th>
                                <th>Transaction Type</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customer_transactions as $customer_transaction)
                            <tr>
                                <td>{{$customer_transaction->id}}</td>
                                <td>{{$customer_transaction->order_id}}</td>
                                <td>{{$customer_transaction->customer_name??'Walk-in Client'}}</td>
                                <td>{{$customer_transaction->amount}}</td>
                                <td>{{$customer_transaction->payment_type}}</td>
                                <td>{{$customer_transaction->payment_date}}</td>
                                <td>
                                    <a href="{{route('customer-accounts.show', $customer_transaction->id)}}">
                                        <button class="btn btn-success btn-sm">View</button>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan=6>No Records</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</div>




@endsection

@section('scripts')
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
@endsection