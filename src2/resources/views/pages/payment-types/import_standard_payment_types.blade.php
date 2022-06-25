@extends('layout.default')
@section('title', 'Standard Payment Types')
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}">
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Import Standard Payment Types</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                      
                        <li class="breadcrumb-item">
                            <a href="{{route('payment-types.index')}}" class="text-muted">Payment Types</a>
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
                                <h3 class="card-label">Import Standard Payment Types
                                    {{-- <span class="d-block text-muted pt-2 font-size-sm">Select customers from the list below to send sms reminder</span> --}}
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('standard-payment-types.store') }}" id="customer_transaction_form">
                                @csrf
                                <table class="table table-separate table-head-custom" id="import-companies">
                                    <thead>
                                        <tr>
                                            <th>
                                                @if (!$standard_payment_types->isEmpty())
                                                    <label class="checkbox" >
                                                        <input type="checkbox" class="checkAll" />
                                                        <span></span>
                                                    </label>
                                                @endif
                                                
                                            </th>
                                            
                                            <th>Title</th>
                                            <th>Value</th>
                                            <th>Description</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($standard_payment_types as $standard_payment_type)
                                            <tr>
                                                <td>
                                                    <label class="checkbox">
                                                        <input type="checkbox" class="check" value="{{$standard_payment_type->id}}" name="payment_type_id[]"/>
                                                        <span></span>
                                                    </label>
                                                    
                                                </td>
                                                
                                                <td>
                                                    {{$standard_payment_type->title}}
                                                </td>
                                                <td>
                                                   {{$standard_payment_type->value}}
                                                </td>
                                                <td>
                                                   {{$standard_payment_type->description}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                        
                                    </tbody>
                                </table>
                                <div class="card-footer text-right">
                                    <div class="form-group mb-0">
                                        @if (!$standard_payment_types->isEmpty())
                                            <button class="btn btn-primary px-12 btn-shadow ">Import</button>
                                        @endif
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
    {{--vendors--}}
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5')}}"></script>

    {{-- Products Data --}}
    <script src="{{asset('js/pages/crud/datatables/basic/paginations.js?v=7.0.5')}}"></script>  
    <script>
        $(".checkAll").click(function () {
            $(".check").prop('checked', $(this).prop('checked'));
        });
    </script>
    <script src="{{asset('js/customer_accounts/form_validation.js')}}"></script>
@endsection