@extends('layout.default')
@section('title', 'Add Invoice Data')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/wizard/wizard-3.css?v=7.2.9')}}">
    <style>
        #invoice_title {
            width: 100%;
            border: 0;
            outline: 0;
            border-bottom: 2px solid #a1a1a1;
            font-size: 1.4rem;
            /* color: #ccc; */
                    
        }
        #invoice_title:focus {
            border-bottom: 2px solid #E30423;                    
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Smart Invoicing</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{route('customer-accounts.index')}}" class="text-muted">Create Invoice</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Add Invoice Data</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <a href="#" id="print" class="btn btn-primary mx-1 font-weight-bold">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Devices\Printer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"></path>
                                <rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"></rect>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span> Print
                </a>
                <a href="#" id="save" class="btn btn-light-success mx-1 font-weight-bold" data-toggle="modal" data-target="#exampleModalCenter">
                   <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
                                <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span> Save
                </a>
                {{-- <div class="dropdown dropdown-inline">
                    <a href="#" class="btn btn-light-primary font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="svg-icon">
                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Devices\Printer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"></path>
                                    <rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"></rect>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span> Print
                    </a>
                    <div class="dropdown-menu dropdown-menu-md py-5">
                        <ul class="navi navi-hover navi-link-rounded-lg">
                            <li class="navi-item">
                                <a class="navi-link" href="#" id="thermal">
                                    <span class="navi-text">Thermal</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a class="navi-link" href="#" id="a4">
                                    <span class="navi-text">A4</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div> --}}
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid px-0">
            <!--begin::Teachers-->
            <div class="row" data-sticky-container>
                <!--begin::Content-->
                    <div class="col-xl-6 mb-3">
                        <!--begin::Card-->
                        <form action="{{route('invoice.save-invoice-data')}}" name="invoice_form" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- Header Fields --}}
                            <div class="card card-custom border">
                                <div class="card-header flex-wrap py-5">
                                    <div class="card-title">
                                        <h3 class="card-label">
                                            Header Fields
                                        </h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <a type="button" class="btn btn-primary btn-square btn-sm" data-toggle="modal" data-target="#ChangeHeaderLabelsModal">Change Labels</a>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <input type="hidden" name="header_tag" value="{{$header_template}}">

                                        @foreach ($invoice_headers as $invoice_header)
                                            <input type="hidden" name="header_options[]" value="{{$invoice_header->option}}">

                                            @if (!str_contains($invoice_header->option,'label'))
                                                @if (isset($outlet))
                                                    @if ($invoice_header->option=='outlet_logo')
                                                        <div class="col-xl-12 mb-5">
                                                            <label>{{ucwords(str_replace('_',' ',$invoice_header->option))}}</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input file-fields" value="{{$outlet->outlet_feature_img}}" name="{{$invoice_header->option}}" data-id="{{$invoice_header->option}}" id="customFile"/>
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-xl-6 mb-5">
                                                            <label>{{ucwords(str_replace('value', '',str_replace('_',' ',$invoice_header->option)))}}</label>
                                                            
                                                            @if (str_contains($invoice_header->option, 'outlet_title'))
                                                                <input type="text" value="{{$outlet->outlet_title}}"  name="{{$invoice_header->option}}" class="form-control fields" data-id="{{$invoice_header->option}}">
                                                        
                                                            @elseif (str_contains($invoice_header->option, 'outlet_address'))
                                                                <input type="text" value="{{$outlet->outlet_address??$invoice_header->value}}"  name="{{$invoice_header->option}}" class="form-control fields" data-id="{{$invoice_header->option}}">

                                                            @elseif (str_contains($invoice_header->option, 'outlet_phone'))
                                                                <input type="text" value="{{$outlet->outlet_phone??$invoice_header->value}}"  name="{{$invoice_header->option}}" class="form-control fields" data-id="{{$invoice_header->option}}">

                                                            @elseif (str_contains($invoice_header->option, 'outlet_email'))
                                                                <input type="text" value="{{$outlet->outlet_email??$invoice_header->value}}"  name="{{$invoice_header->option}}" class="form-control fields" data-id="{{$invoice_header->option}}">

                                                            @else
                                                                @if (str_contains($invoice_header->option,'customer_name'))
                                                                    @if (isset($customers))
                                                                        <input type="hidden" name="{{$invoice_header->option}}" >
                                                                        <div class="input-group">
                                                                            <select  class="form-control selectpicker customer_fields" id="customer" name="customer_id" data-size="5" data-live-search="true" data-id="{{$invoice_header->option}}" >
                                                                                <option value="">Select Customer</option>
                                                                                @foreach ($customers as $key => $customer)
                                                                                    @if ($key > 0)
                                                                                        <option value="{{$customer->id}}" data-customer-phone="{{$customer->customer_phone}}" data-customer-address="{{$customer->customer_address}}">{{$customer->customer_name}}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                            <div class="input-group-append">
                                                                                <button class="btn btn-outline-secondary py-0" type="button"
                                                                                    data-toggle="modal" data-target="#customer_model">
                                                                                    <span class="svg-icon svg-icon-success svg-icon-2x ">
                                                                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                                                fill-rule="evenodd">
                                                                                                <rect x="0" y="0" width="24" height="24" />
                                                                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12"
                                                                                                    r="10" />
                                                                                                <path
                                                                                                    d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                                                                    fill="#000000" />
                                                                                            </g>
                                                                                        </svg>
                                                                                        <!--end::Svg Icon-->
                                                                                    </span>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <input type="text" value="{{$invoice_header->value}}"  name="{{$invoice_header->option}}" class="form-control fields" data-id="{{$invoice_header->option}}">
                                                                    @endif
                                                                @else
                                                                    <input type="text" value="{{$invoice_header->value}}"  name="{{$invoice_header->option}}" class="form-control fields" data-id="{{$invoice_header->option}}">
                                                                @endif
                                                            @endif
                                                            
                                                        </div>
                                                    @endif
                                                @else
                                                    @if ($invoice_header->option=='outlet_logo')
                                                        <div class="col-xl-12 mb-5">
                                                            <label>{{ucwords(str_replace('_',' ',$invoice_header->option))}}</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input file-fields" name="{{$invoice_header->option}}" data-id="{{$invoice_header->option}}" id="customFile"/>
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-xl-6 mb-5">
                                                            <label>{{ucwords(str_replace('value', '',str_replace('_',' ',$invoice_header->option)))}}</label>
                                                            
                                                            <input type="text" value="{{$invoice_header->value}}"  name="{{$invoice_header->option}}" class="form-control fields" data-id="{{$invoice_header->option}}">                                                  
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="form-group row">
                                        @if (isset($header_custom_fields))
                                            @foreach ($header_custom_fields as $header_custom_field)
                                            {{-- {{$header_custom_field}} --}}
                                                <div class="col-xl-6 mb-5">
                                                    <label>{{$header_custom_field}}</label>
                                                    <input type="hidden" name="header_options[]" value="{{$header_custom_field}}">
                                                    @php
                                                        $header_custom_field_id=str_replace('.',' ',$header_custom_field);
                                                        $header_custom_field_id=str_replace(' ','_',$header_custom_field_id);
                                                    @endphp
                                                    <input type="text" class="form-control fields" name="{{$header_custom_field_id}}" data-id="{{$header_custom_field_id}}">
                                                </div>
                                            
                                            @endforeach
                                        @endif

                                        @if(isset($invoice_custom_headers))
                                            @foreach ($invoice_custom_headers as $invoice_custom_header)
                                                <div class="col-xl-6 mb-5">
                                                    <label>{{$invoice_custom_header->option}}</label>
                                                    <input type="hidden" name="header_options[]" value="{{$invoice_custom_header->option}}">
                                                    <input type="text" class="form-control fields" name="{{$invoice_custom_header->option}}" value="{{$invoice_custom_header->value}}" data-id="{{$invoice_custom_header->option}}">
                                                </div>
                                                {{-- <p>
                                                    <span>{{$invoice_custom_header->option}}</span>:
                                                    <b id="{{$invoice_custom_header->value}}">{{$invoice_custom_header->value}}</b>
                                                </p> --}}
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Body Fields --}}
                            <div class="card card-custom my-10">
                                <div class="card-header flex-wrap py-5">
                                    <div class="card-title">
                                        <h3 class="card-label">
                                            Body
                                        </h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <a type="button" id="add_row" class="btn btn-primary">Add row</a>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <input type="hidden" name="body_tag" value="{{$body_template}}">
                                    <input type="hidden" name="row_count" value="1">

                                    <table class="table" id="body_table">
                                        <thead class="thead-dark">
                                            <tr>
                                                @foreach ($invoice_body_headers as $invoice_body_header)
                                                    <th class="column">
                                                        <input type="hidden" name="body_header_options[]" value="{{$invoice_body_header->option}}">
                                                        @php
                                                            $column_edit_id=str_replace('.',' ',$invoice_body_header->option);
                                                        @endphp
                                                        <span class="column_label" data-id="{{str_replace(' ','_',$column_edit_id)}}">
                                                            {{ucfirst($invoice_body_header->value)}}
                                                        </span>
                                                        <input type="hidden" name="{{$invoice_body_header->option}}" class="body_header_value" value="{{$invoice_body_header->value}}">
                                                        <input type="text" class="column_edit" id="{{str_replace(' ','_',$column_edit_id)}}" style="display:none;">
                                                    </th>                              
                                                @endforeach
                                                {{-- @for ($i = 0; $i < count($body_header_custom_fields); $i++)
                                                    <th class="column">
                                                        <span class="column_label" data-id="{{str_replace(' ','_',$body_header_custom_fields[$i])}}">
                                                            {{ucfirst($body_header_custom_fields[$i])}}
                                                        </span>
                                                        <input type="text" class="column_edit" id="{{str_replace(' ','_',$body_header_custom_fields[$i])}}" style="display:none;">
                                                    </th> 
                                                @endfor --}}
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="row_1">
                                                @foreach ($invoice_body_headers as $id => $invoice_body_header)
                                                    <td class="align-middle">
                                                        <input type="text" name="row_1_column[]" class="form-control form-control-sm body-data-value">
                                                    </td>                              
                                                @endforeach
                                                {{-- @for ($i = 0; $i < count($body_header_custom_fields); $i++)
                                                    <td class="align-middle">
                                                        <input type="text" name="column_[]" class="form-control form-control-sm body-data-value">
                                                    </td>
                                                @endfor --}}
                                                <td class="align-middle">
                                                    <a href="javascript:;" id="1" class="btn btn-sm btn-danger btn-icon remove">
                                                        <i class="la la-remove"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Footer Fields --}}
                            <div class="card card-custom mt-10">
                                <div class="card-header flex-wrap py-5">
                                    <div class="card-title">
                                        <h3 class="card-label">
                                            Footer Fields
                                        </h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <a type="button" class="btn btn-primary btn-square btn-sm" data-toggle="modal" data-target="#ChangeFooterLabelsModal">Change Labels</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="footer_tag" value="{{$footer_template}}">
                                    <div class="from-control row">
                                        @foreach ($invoice_footers as $invoice_footer)
                                        <input type="hidden" name="footer_options[]" value="{{$invoice_footer->option}}">
                                        @if (!str_contains($invoice_footer->option,'label'))
                                            <div class="col-xl-6 mb-5">
                                                <label>{{ucwords(str_replace('value', '',str_replace('_',' ',$invoice_footer->option)))}}</label>
                                                <input type="text" value="{{$invoice_footer->value}}" name="{{$invoice_footer->option}}" data-id="{{$invoice_footer->option}}" class="form-control fields">
                                            </div>
                                        @endif
                                        @endforeach
                                    </div>

                                    <div class="form-group row">
                                        @foreach ($footer_custom_fields as $footer_custom_field)
                                        <input type="hidden" name="footer_options[]" value="{{$footer_custom_field}}">
                                            <div class="col-xl-6 mb-5">
                                                <label>{{$footer_custom_field}}</label>
                                                <input type="text" class="form-control fields" name="{{$invoice_footer->option}}" data-id="{{$footer_custom_field}}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Header label modal --}}
                            <div class="modal fade" id="ChangeHeaderLabelsModal"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="card">
                                            <div class="card-body my-10">
                                                <div class="form-group row">
                                                    @foreach ($invoice_headers as $invoice_header)
                                                        @if (str_contains($invoice_header->option, 'label'))
                                                            <div class="col-xl-6 mb-4">
                                                                <input type="text" class="form-control fields" name="{{$invoice_header->option}}" value="{{$invoice_header->value}}" data-id="{{$invoice_header->option}}">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- footer label modal --}}
                            <div class="modal fade" id="ChangeFooterLabelsModal"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="card">
                                            <div class="card-body my-10">
                                                <div class="form-group row">
                                                    @foreach ($invoice_footers as $invoice_footer)
                                                        @if (str_contains($invoice_footer->option, 'label'))
                                                            <div class="col-xl-6 mb-4">
                                                                <input type="text" class="form-control fields" name="{{$invoice_footer->option}}" value="{{$invoice_footer->value}}" data-id="{{$invoice_footer->option}}">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal-->
                            <div class="modal fade" id="exampleModalCenter"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="card">
                                            <div class="card-body my-10">
                                                <div class="form-group row mb-0">
                                                    <div class="col-xl-12 mb-5">
                                                        <input type="text" id="invoice_title" name="invoice_title" placeholder="Enter Invoice Title">
                                                    </div>
                                                    <div class="col-xl-12 text-right">
                                                        <button class="btn btn-primary" id="btn-save">Save Invoice</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </form>

                        <div class="modal fade" id="customer_model" data-backdrop="static" tabindex="-1" role="dialog"
                            aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <form id="add_customer_form" class="add_customer">
                                        <div class="modal-header ">
                                            <h5 class="modal-title" id="customer_model">Add Customer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Customer Name*</label>
                                                <input type="text" class="form-control" name="customer_name" placeholder="Customer Name" />
                                            </div>
                                            <div class="form-group">
                                                <label>Customer Phone</label>
                                                <input type="text" class="form-control" name="customer_phone" placeholder="Customer Phone" />
                                            </div>
                                            <div class="form-group">
                                                <label>Customer Address</label>
                                                <input type="text" class="form-control" name="customer_address"
                                                    placeholder="Customer Address" />
                                            </div>
                                            <div class="form-group ">
                                                <label class="col-12 col-form-label">Allow Credit Purchases</label>
                                                <div class="col-12">
                                                    <span class="switch switch-outline switch-icon switch-success">
                                                        <label>
                                                            <input type="checkbox" name="allow_credit"
                                                                {{ old('allow_credit') == 1 ? 'checked' : '' }} value="1" />
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                            <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                                        </div>
                                        <div class="modal-footer py-3">
                                            <span id="customer_added"></span>
                                            <button type="submit" class="btn btn-primary btn-shadow px-12" id="btn">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!--end::Card-->
                    </div>
                    <div class="col-xl-6">
                        <!--begin::Card-->
                        <div class="card card-custom" style="position: fixed; height:80vh; overflow-y:auto; overflow-x:hidden" >
                            <div class="card-body p-0" id="invoice_print">
                                @include('pages.smart_invoice.templates.index')
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
        function showAllFields() {
            $('.fields').each(function() {
                $('#'+$(this).attr('data-id')).text($(this).val());
            }).get();
        }
        showAllFields();

        $('.fields').each(function() {
           $('#'+$(this).attr('data-id')).text($(this).val());
        }).get();
       
        $('.column').click(function () {
            column_label=$(this).children('.column_label').text();
            data_id=$(this).children('.column_label').attr('data-id');
            $(this).children('.column_label').hide();
            console.log($(this));
            $('#'+ data_id).val(column_label.trim())
            $(this).children('#'+ data_id).show().focus();
        });
            
        $('.column_edit').focusout(function() {
            var dad = $(this).parent();
            $(this).hide();
            dad.children('.column_label').text($(this).val());
            dad.children('.body_header_value').val($(this).val());
            dad.children('.column_label').show();
            invoice_column_label_class=dad.children('.column_label').attr('data-id');
            // console.log(data_id);
            $('.invoice_body_column').children('.'+invoice_column_label_class).text($(this).val());
        });

        $('.file-fields').change(function(){
            const file = this.files[0];
            const data_id = $(this).attr('data-id');
            if (file){
                let reader = new FileReader();
                reader.onload = function(event){
                    $('#'+data_id).attr('src', event.target.result)
                }
                reader.readAsDataURL(file);
            }
        });

        $('.fields').on('keyup change',function () {
            console.log($('#'+$(this).attr('data-id')));
            $('#'+$(this).attr('data-id')).text($(this).val());
        });

        $('.customer_fields').change(function () {
            if ($(this).val()!='') {
                $('input[name="'+$(this).attr('data-id')+'"]').val($(this).find(":selected").text())
                $('input[name="customer_name_value"]').val($(this).find(":selected").text())
                $('input[name="customer_phone_value"]').val($(this).find(":selected").data('customer-phone'))
                $('input[name="customer_address_value"]').val($(this).find(":selected").data('customer-address'))
                $('#'+$(this).attr('data-id')).text($(this).find(":selected").text());
                showAllFields();   
            }else{
                $('input[name="'+$(this).attr('data-id')+'"]').val('')
                $('input[name="customer_phone_value"]').val('')
                $('input[name="customer_address_value"]').val('')
                $('#'+$(this).attr('data-id')).text('');
                showAllFields();
            }
            
        })

        function add_row_body_table(){
            var table_body=$('#body_table > tbody');
            var row_count=table_body.children('tr').length+1;
            $('input[name="row_count"]').val(row_count);
            var col_count="{{count($invoice_body_headers)}}";
            var add_row='<tr id="row_'+row_count+'">';

            for (let index = 0; index < col_count; index++) {
                add_row+='<td class="align-middle">'+
                        '<input type="text" name="row_'+row_count+'_column[]" class="form-control form-control-sm body-data-value">'+
                        '</td>';             
            }                         
            add_row+='<td class="align-middle">'+
                    '<a href="javascript:;" id="'+row_count+'" class="btn btn-sm btn-danger btn-icon remove">'+
                    '<i class="la la-remove"></i>'+
                    '</a>'+
                    '</td>'
                    '</tr>';

            table_body.append(add_row);
        }
        function add_row_invoice_table(){
            var table_body=$('#invoice_table > tbody');
            var row_count=table_body.children('tr').length+1;
            var col_count="{{count($invoice_body_headers)}}";
            // console.log(col_count);

            var add_row='<tr id="inv_row_'+row_count+'">';
            for (let index = 0; index < col_count; index++) {
                add_row+='<td class="align-middle"></td>';  
            }                            
            add_row+='</tr>';

            table_body.append(add_row);
        }
        function remove_row_body_table(row_id){
            var table_body=$('#body_table > tbody');
            var row_count=table_body.children('tr').length-1;
            $('input[name="row_count"]').val(row_count);
            $('#row_' + row_id + '').remove();
        }
        function remove_row_invoice_table(row_id){
            $('#inv_row_' + row_id + '').remove();
        }

        $(document).on('keyup', '.body-data-value', function() {
            current_column=$(this).parent('td');
            current_row_id=current_column.parent('tr').attr('id');
            console.log(current_column.index());
            console.log($('#inv_'+current_row_id).children('td:eq('+current_column.index()+')').text($(this).val()));
        });


        $('#add_row').click(function(){
             add_row_body_table();
             add_row_invoice_table();         
        });

        $(document).on('click', '.remove', function() {
            var row_id = $(this).attr("id");
            remove_row_body_table(row_id);
            remove_row_invoice_table(row_id);
        });
    
   
        $('#print').click(function () {
            w=window.open();
            w.document.write('<html><head>');
            w.document.write('<link href="http://127.0.0.1:8000/css/style.bundle.css" rel="stylesheet" type="text/css" />');
            w.document.write('</head>');
            w.document.write('<body>');
            w.document.write($('#invoice_print').html());
            w.document.write('</body>');
            w.document.write('</html>');
            setTimeout(function () {
                w.print();
                w.close();  
            }, 100);  
            
        })

        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });
        });

        //Add customer 
        $('#btn').on('click', function(event) {
            event.preventDefault();
            $('#btn').attr('disabled', true);
            form = new FormData(document.getElementById("add_customer_form"));
            // data = document.getElementById("add_customer_form"),
            $.ajax({
                url: "{{route('add-customer')}}",
                type: "POST",
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form,
                success: function(response) {

                    $('#customer_model').modal('toggle');
                    $('#btn').attr('disabled', false);
                    toastr.success("Customer Added");
                    $("[name='customer_name']").val("");
                    $("[name='customer_phone']").val("");
                    $("[name='customer_address']").val("");
                    $("[name='outlet_id']").val("");
                    $("[name='created_by']").val("");

                    $.ajax({
                        url: "/get-customer?id=" + response,
                        type: "Get",
                        success: function(res) {
                            $("#customer").append("<option data-customer=" + res.allow_credit + " value='" + res.id + "'>" + res.customer_name + "</option>");
                            $("#customer").selectpicker("refresh");
                            var newVal = $("#customer option:last").val();
                            $("#customer").selectpicker("val", [newVal]);
                            $('input[name="customer_name_value"]').val(res.customer_name)
                            $('input[name="customer_phone_value"]').val(res.customer_phone)
                            $('input[name="customer_address_value"]').val(res.customer_address)
                            $('#'+$('#customer').attr('data-id')).text($('#customer').find(":selected").text());
                            showAllFields();
                        }

                    });
                },
                error: function(response) {
                    toastr.error(response.responseJSON.errors.customer_name[0]);
                    $('#btn').attr('disabled', false);
                }

            });
        });
</script>
@endsection
