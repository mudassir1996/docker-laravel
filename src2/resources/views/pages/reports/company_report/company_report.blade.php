@extends('layout.default')
@section('title', 'Company Report')
@section('content')



<div class="row">
    <div class="col-xl-12 mb-6">
        <div class="card">
            <form action="{{route('company-report.filter')}}" method="get">
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
                                <label for="">Companies</label>
                                <select name="company_id" class="form-control form-control-sm" id="">
                                    <option value="">Nothing Selected</option>
                                    @foreach($companies as $company)
                                    <option value="{{$company->id}}" {{(request()->company_id==$company->id)?'selected':''}}>{{$company->company_title}}</option>
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

                    </div>
                    <button class="btn btn-primary btn-shadow mt-8 col-1" type="submit">Search</button>
                </div>
                
            </form>
        </div>
    </div>


    <div class="col-xl-12 mb-6">
        <div class="row">
            <div class="col-xl-6 ">
                <div class="card">
                    <div class="card-body d-flex flex-column p-2">
                        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                            <div class="d-flex flex-column mr-2">
                                <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Sales by Company</a>
                                <!-- <span class="text-muted font-weight-bold mt-2"</span> -->
                            </div>
                        </div>
                        <div id="my-scroll" style="overflow-y:scroll; height:200px;">
                            <table class="table nowrap ">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Sold Quantity</th>
                                        <th>Sold Amount</th>
                                        <th>Payment Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($company_sales_details as $company_sales)
                                    <tr>
                                        <td>{{$company_sales->company_title}}</td>
                                        <td>
                                            {{$company_sales->sold_quantity}}
                                        </td>
                                        <td>{{$company_sales->sold_amount}}</td>
                                        <td>
                                            @if(request()->payment_type!=null)
                                            {{ucfirst($company_sales->payment_type)}}
                                            @else
                                            All
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('companies.show', $company_sales->id)}}">
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
            <div class="col-xl-6 ">
                <div class="card">
                    <div class="card-body d-flex flex-column p-2">
                        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                            <div class="d-flex flex-column mr-2">
                                <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Purchases by Company</a>
                                <!-- <span class="text-muted font-weight-bold mt-2"</span> -->
                            </div>
                        </div>
                        <div id="my-scroll" style="overflow-y:scroll; height:200px;">
                            <table class="table nowrap ">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Purchased Quantity</th>
                                        <th>Purchased Amount</th>
                                        <th>Payment Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($company_purchase_details as $company_purchase)
                                    <tr>
                                        <td>{{$company_purchase->company_title}}</td>
                                        <td>
                                            {{$company_purchase->purchased_quantity}}
                                        </td>
                                        <td>{{$company_purchase->purchased_amount}}</td>
                                        <td>
                                            @if(request()->payment_type!=null)
                                            {{ucfirst($company_purchase->payment_type)}}
                                            @else
                                            All
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('companies.show', $company_purchase->id)}}">
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
    </div>





</div>




@endsection

@section('scripts')
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
@endsection