@extends('layout.default')
@section('title', 'Expense Report')
@section('content')



<div class="row">
    <div class="col-xl-12 mb-6">
        <div class="card">
            <form action="{{route('expense_report.filter')}}" method="post">
                @csrf
                <div class="card-header p-4 d-flex flex-column">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Filter</a>
                </div>
                <div class="card-body d-flex flex-column p-5">
                    <div class="form-group row mb-1">
                        <div class="col-xl-2">
                            <div class="form-group mb-0">
                                <label for="">From Date</label>
                                <input type="text" id="datepicker_from" readonly value="{{(request()->from_date!='')?request()->from_date:''}}" class="form-control form-control-sm" name="from_date" placeholder="Select Date">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group mb-0">
                                <label for="">To Date</label>
                                <input type="text" id="datepicker_to" readonly value="{{(request()->to_date!='')?request()->to_date:''}}" class="form-control form-control-sm" name="to_date" placeholder="Select Date">
                            </div>
                        </div>
                        {{-- <div class="col-xl-2">
                            <div class="form-group mb-0">
                                <label for="">Status</label>
                                <select name="status" class="form-control form-control-sm" id="">
                                    <option value="">Nothing Selected</option>
                                    <option value="completed" {{(request()->status=='completed')?'selected':''}}>Completed</option>
                                    <option value="on-hold" {{(request()->status=='on-hold')?'selected':''}}>On-hold</option>
                                    <option value="returned" {{(request()->status=='returned')?'selected':''}}>Returned</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-2">
                            <div class="form-group mb-0">
                                <label for="">Customer</label>
                                <select name="customer_id" class="form-control form-control-sm" id="">
                                    <option value="">Nothing Selected</option>
                                    <option value="0" {{(request()->customer_id=='0')?'selected':''}}>Walk-in Client</option>
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" {{(request()->customer_id==$customer->id)?'selected':''}}>{{$customer->customer_name}}</option>
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
                        <div class="col-xl-2">
                            <div class="form-group mb-0">
                                <label for="">Created By</label>
                                <select name="created_by" class="form-control form-control-sm" id="">
                                    <option value="">Nothing Selected</option>
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}" {{(request()->created_by==$user->id)?'selected':''}}>{{$user->username}}</option>
                                    @endforeach
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
                        </div> --}}
                    </div>
                    <button class="btn btn-primary btn-shadow mt-8 col-1" type="submit">Search</button>
                </div>

            </form>
        </div>
    </div>


    {{-- <div class="col-xl-5">
        <div class="card">
            <div class="card-body d-flex flex-column p-2">
                <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                    <div class="d-flex flex-column mr-2">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Sales Report</a>
                        <span class="text-muted font-weight-bold mt-2">Sales from {{$fromDate}} to {{$toDate}}</span>
                    </div>
                </div>
                <div>
                    {!! $salesChart->container() !!}
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <div class="col-xl-7">
        <div class="row">
            <div class="col-xl-6">
                <!--begin::Tiles Widget 2-->
                <div class="card card-custom bg-danger gutter-b" style="height: 175px">
                    <!--begin::Body-->
                    <div class="card-body p-0" style="position: relative;">
                        <!--begin::Stats-->
                        <div class="card-spacer  pb-0">
                            <div class="text-inverse-danger font-weight-bold">Total Profit</div>
                            <div class="text-inverse-danger font-weight-bolder font-size-h3">PKR {{$total_profit}}</div>
                            <div class="progress progress-xs mt-21">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end::Stats-->
                        <!--begin::Chart-->

                        <!--end::Chart-->
                        <div class="resize-triggers">
                            <div class="expand-trigger">
                                <div style="width: 250px; height: 176px;"></div>
                            </div>
                            <div class="contract-trigger"></div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Tiles Widget 2-->

            </div>
            <div class="col-xl-6">
                <!--begin::Tiles Widget 4-->
                <div class="card card-custom gutter-b" style="height: 175px">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <!--begin::Stats-->
                        <div class="flex-grow-1">
                            <div class="text-dark-50 font-weight-bold">Total Sales</div>
                            <div class="font-weight-bolder font-size-h3">PKR {{$total_sales}}</div>
                        </div>
                        <!--end::Stats-->
                        <!--begin::Progress-->
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Tiles Widget 4-->
            </div>

        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body d-flex flex-column p-2">
                        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                            <div class="d-flex flex-column mr-2">
                                <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Top Products</a>
                                <span class="text-muted font-weight-bold mt-2">From {{$fromDate}} to {{$toDate}}</span>
                            </div>
                        </div>
                        <div id="my-scroll" style="overflow-y:scroll; height:200px;">
                            <table class="table nowrap ">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($top_products as $top_product)
                                    <!-- {{$top_product}} -->
                                    <tr>
                                        <td>{{$top_product->product_title}}</td>


                                        <td>
                                            <a href="{{route('products.show', $top_product->product_id)}}">
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

    </div> --}}
</div>

    <div class="row">
        <div class="col-xl-12 mt-3">
            <div class="card">
                <div class="card-body">
                   <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Expense Categories Report</a>
                    <div>
                        <table class="table table-separate table-head-custom nowrap table-checkable" id="kt_expense_report">
                            <thead>
                                <tr>
                                    <th>Expense Category</th>
                                    <th>Total Transactions</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                    {{-- @php
                                        $i = 0
                                    @endphp --}}
                                @foreach($all_transactions as $all_transaction)

                                <tr>
                                    {{-- <td>{{ ++$i }}</td> --}}
                                    <td>{{$all_transaction['expense_category']}}</td>
                                    <td>{{ $all_transaction['transactions'] }}</td>
                                    <td>{{ $all_transaction['expense_transaction_amount'] }}</td>


                                    <td>
                                        <a href="/outlets/reports/expense-report/{{ $fromDate }}/{{ $toDate }}/{{ $all_transaction['expense_category_id'] }}">
                                             <i class="text-primary h3 la la-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        {{-- <div class="col-xl-6 mt-3">
            <div class="card">
                <div class="card-body d-flex flex-column p-2">
                    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                        <div class="d-flex flex-column mr-2">
                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Top 10 Purchased Products</a>
                            <span class="text-muted font-weight-bold mt-2">From {{$fromDate}} to {{$toDate}}</span>
                        </div>
                    </div>
                    <div>
                        <table class="table nowrap">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0
                                @endphp
                                @forelse($top_products as $top_product)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{$top_product->product_title}}</td>
                                    <td>{{abs($top_product->total_quantity)}}</td>


                                    <td>
                                        <a href="{{route('products.show', $top_product->product_id)}}">
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
        </div> --}}
    </div>

    {{-- <div class="row mt-6">
        <div class="col-xl-12 mt-3">
            <div class="card">
                <div class="card-body d-flex flex-column p-2">
                    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                        <div class="d-flex flex-column mr-2">
                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Top 5 Suppliers</a>
                            <span class="text-muted font-weight-bold mt-2">From {{$fromDate}} to {{$toDate}}</span>
                        </div>
                    </div>
                    <div>
                        <table class="table nowrap">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Supplier Name</th>
                                    <th>Total Purchases</th>
                                    <th>Total Amount</th>

                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 0
                            @endphp
                                @forelse($top_suppliers as $top_supplier)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{$top_supplier->supplier_title}}</td>
                                    <td>{{ $top_supplier->total_purchases }}</td>
                                    <td>{{$top_supplier->total_amount}}</td>


                                    <td>
                                        <a href="{{route('products.show', $top_product->product_id)}}">
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



    </div> --}}

    {{-- <div class="row mt-6">
        <div class="col-xl-6 mt-3">
            <div class="card">
                <div class="card-body d-flex flex-column p-2">
                    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                        <div class="d-flex flex-column mr-2">
                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Top Categories</a>
                            <span class="text-muted font-weight-bold mt-2">From {{$fromDate}} to {{$toDate}}</span>
                        </div>
                    </div>
                    <div>
                        <table class="table nowrap">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Category</th>
                                    <th>Purchases</th>
                                    <th>Products</th>
                                    <th>Amount</th>

                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 0
                            @endphp
                                @forelse($top_categories as $top_category)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{$top_category['category_name']}}</td>
                                    <td>{{$top_category['total_purchases']}}</td>
                                    <td>{{$top_category['product_quantity']}}</td>
                                    <td>{{$top_category['product_amount']}}</td>


                                    <td>
                                        <a href="{{route('products.show', $top_product->product_id)}}">
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
        <div class="col-xl-6 mt-3">
            <div class="card">
                <div class="card-body d-flex flex-column p-2">
                    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                        <div class="d-flex flex-column mr-2">
                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Top Companies</a>
                            <span class="text-muted font-weight-bold mt-2">From {{$fromDate}} to {{$toDate}}</span>
                        </div>
                    </div>
                    <div>
                        <table class="table nowrap">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Company</th>
                                    <th>Purchases</th>
                                    <th>Products</th>
                                    <th>Amount</th>

                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 0
                            @endphp
                                @forelse($top_companies as $top_company)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{$top_company['company_name']}}</td>
                                    <td>{{$top_company['total_purchases']}}</td>
                                    <td>{{$top_company['product_quantity']}}</td>
                                    <td>{{$top_company['product_amount']}}</td>


                                    <td>
                                        <a href="{{route('products.show', $top_product->product_id)}}">
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

    </div> --}}

{{-- </div> --}}



@endsection

{{-- Styles Section --}}
<!-- @section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection -->


{{-- Scripts Section --}}

@section('scripts')
{{--vendors--}}
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5')}}"></script>

{{-- Products Data --}}
<script src="{{asset('js/pages/crud/datatables/basic/reports_tables.js')}}"></script>
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
@endsection
