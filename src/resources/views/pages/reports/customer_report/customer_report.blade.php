@extends('layout.default')
@section('title', 'Customer Report')
@section('content')



<div class="row">
    <div class="col-xl-12 mb-6">
        <div class="card">
            <form action="{{route('customer-report.filter')}}" method="get">
                @csrf
                <div class="card-header p-4 d-flex flex-column">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Filter</a>
                </div>
                <div class="card-body d-flex flex-column p-5">
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




    <div class="col-xl-7">
        <div class="card">
            <div class="card-body d-flex flex-column p-2">
                <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                    <div class="d-flex flex-column mr-2">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Purchase Report</a>

                    </div>
                </div>
                <div id="my-scroll" style="overflow-y:scroll; height:260px;">
                    <table class="table nowrap ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Total Bill</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sales_orders as $sales_order)
                            <tr>
                                <td>{{$sales_order->id}}</td>
                                <td>{{$sales_order->customer_name??'Walk-in Client'}}</td>
                                <td>{{$sales_order->amount_payable}}</td>
                                <td>{{$sales_order->order_completion_date}}</td>
                                <td>
                                    <a href="{{route('sales-orders', $sales_order->id)}}">
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
    <div class="col-xl-5 mt-xs-6">
        <div class="row">
            <div class="col-xl-6 col-4">
                <!--begin::Tiles Widget 2-->
                <div class="card card-custom bg-danger gutter-b" style="height: 175px">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <!--begin::Stats-->
                        <div class="flex-grow-1">
                            <div class="text-inverse-danger font-weight-bold">Average Purchases</div>
                            <div class="text-inverse-danger font-weight-bolder font-size-h3">PKR {{round($avg_buy_amount)}}</div>

                        </div>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!--end::Stats-->
                        <!--begin::Chart-->


                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Tiles Widget 2-->

            </div>
            <div class="col-xl-6 col-4">
                <!--begin::Tiles Widget 4-->
                <div class="card card-custom gutter-b" style="height: 175px">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <!--begin::Stats-->
                        @if(request()->customer_id!=null)
                        <div class="flex-grow-1">
                            <div class="text-dark-50 font-weight-bold">Total Balance</div>
                            <div class="font-weight-bolder font-size-h3">{{$customer_balance}}</div>
                        </div>
                        @else
                        <div class="flex-grow-1">
                            <div class="text-dark-50 font-weight-bold">Total Balance</div>
                            <div class="font-weight-bolder font-size-h5">Select Customer First</div>
                        </div>
                        @endif
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
            <div class="col-xl-6 col-4">
                <!--begin::Tiles Widget 4-->
                <div class="card card-custom gutter-b" style="height: 175px">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <!--begin::Stats-->
                        <div class="flex-grow-1">
                            <div class="text-dark-50 font-weight-bold">Average Quantity Bought</div>
                            <div class="font-weight-bolder font-size-h3">{{round($avg_buy_quantity)}}</div>
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
    </div>

    <div class="col-xl-12 mb-6">
        <div class="card">

            <div class="card-header p-4 d-flex flex-column">
                <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Most Purchased Products</a>
            </div>
            <div class="card-body d-flex flex-column p-4">
                <div id="my-scroll" style="overflow-y:scroll; height:260px;">
                    <table class="table nowrap ">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Title</th>
                                <th>Quantity</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($most_purchased as $data)
                            <tr>
                                <td>{{$data->product_id}}</td>
                                <td>{{$data->product_title}}</td>
                                <td>{{round($data->total_quantity)}}</td>

                                <td>
                                    <a href="{{route('products.show', $data->product_id)}}">
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