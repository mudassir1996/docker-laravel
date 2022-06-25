@extends('layout.default')
@section('title', 'SMS Reminder')
@section('styles')
    <style>
        #radioBtn .notActive {
            color: #000;
            background-color: #fff;
        }
    </style>
@endsection
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">SMS to Creditors</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                      
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">SMS reminder</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container px-0">
            <!--begin::Teachers-->
            <div class="d-flex flex-row">
                <!--begin::Content-->
                <div class="flex-row-fluid">
                    <!--begin::Card-->
                    <div class="card card-custom card-sticky" id="kt_page_sticky_card">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">SMS to Creditors
                                    <span class="d-block text-muted pt-2 font-size-sm">Select customers from the list below to send sms reminder</span>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('sms-reminder.send') }}" id="customer_transaction_form">
                                @csrf
                                <table class="table table-separate table-head-custom">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="checkbox" >
                                                    <input type="checkbox" class="checkAll" />
                                                    <span></span>
                                                </label>
                                            </th>
                                            <th>Customer Name</th>
                                            <th>Customer phone</th>
                                            <th>Remaining Credit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($creditors as $creditor)
                                            @if ($creditor[0]->balance < 0)
                                             
                                                <tr>
                                                    <td>
                                                        @if ($creditor[0]->customer_phone)
                                                            <label class="checkbox">
                                                                <input type="checkbox" class="check" value="{{$creditor[0]->customer_id}}" name="recipients[]"/>
                                                                <span></span>
                                                            </label>
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                    
                                                        {{$creditor[0]->customer_name}}
                                                    </td>
                                                    <td>
                                                        @if ($creditor[0]->customer_phone)
                                                        
                                                            {{$creditor[0]->customer_phone}}
                                                        @else
                                                            Phone number does not exists. <a href="{{ route('customers.edit',$creditor[0]->customer_id)}}">Add here</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        
                                                        {{$creditor[0]->balance}}
                                                    </td>
                                                </tr>
                                               
                                            @endif
                                        @endforeach
                                        
                                        
                                    </tbody>
                                </table>
                                <div class="card-footer text-right">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary px-12 btn-shadow ">Send SMS</button>
                                    </div>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Teachers-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection



{{-- Scripts Section --}}

@section('scripts')
    <script>
        $(".checkAll").click(function () {
            $(".check").prop('checked', $(this).prop('checked'));
        });
    </script>
    <script src="{{asset('js/customer_accounts/form_validation.js')}}"></script>
@endsection