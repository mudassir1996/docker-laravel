@extends('layout.default')
@section('title', 'Supplier Report')
@section('content')



<div class="row">
    <div class="col-xl-12 mb-6">
        <div class="card">
            <form action="{{route('supplier-report.filter')}}" method="get">
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
                                <label for="">Suppliers</label>
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
            <div class="col-xl-12 ">
                <div class="card">
                    <div class="card-body d-flex flex-column p-2">
                        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                            <div class="d-flex flex-column mr-2">
                                <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Supplier Purchases</a>
                                <!-- <span class="text-muted font-weight-bold mt-2"</span> -->
                            </div>
                        </div>
                        <div id="my-scroll" style="overflow-y:scroll; height:200px;">
                            <table class="table nowrap ">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Companies</th>
                                        <th>Total Orders</th>
                                        <th>Total Purchased</th>
                                        <th>Payment Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($supplier_details as $supplier_detail)
                                    <tr>
                                        <td>{{$supplier_detail->supplier_title}}</td>
                                        <td>
                                            @foreach($supplier_detail->company as $key => $item)
                                            <span class="badge badge-success my-1">{{ $item->company_title }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{$supplier_detail->orders}}</td>
                                        <td>{{round($supplier_detail->total_purchased)}}</td>
                                        <td>
                                            @if(request()->payment_type!=null)
                                            {{$supplier_detail->payment_type}}
                                            @else
                                            All
                                            @endif


                                        </td>
                                        <td>
                                            <a href="{{route('suppliers.show', $supplier_detail->id)}}">
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