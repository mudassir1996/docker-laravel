@extends('layout.default')
@section('title', 'Select Template')
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
                            <a href="{{route('customer-accounts.index')}}" class="text-muted">Invoices</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Select Template</a>
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
        <div class="container-fluid px-0">
            <!--begin::Teachers-->
            <div class="d-flex flex-row">
                <!--begin::Content-->
                <div class="flex-row-fluid">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">Select Invoice Template
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Accounts</span> -->
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <!--begin::Button-->
                                <a href="{{route('invoice.list')}}" class="btn btn-primary font-weight-bolder mx-2">
                                    <span class="svg-icon svg-icon-md">
                                        <!--begin::Svg Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>My Invoices</a>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <a href="{{route('invoice.wizard')}}" class="btn btn-primary font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <!--begin::Svg Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>Create New Invoice</a>
                                <!--end::Button-->
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title" data-toggle="collapse" data-target="#collapseOne1">
                                            Standard Templates
                                        </div>
                                    </div>
                                    <div id="collapseOne1" class="collapse show" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            <ul class="row m-0 p-0" role="tablist">
                                                @for ($i = 0; $i < 10; $i++)
                                                    <!--begin::Item-->
                                                    <li class="d-flex col-sm-2 mb-3">
                                                        <a class="nav-link border py-4 d-flex flex-grow-1 rounded flex-column align-items-center text-dark-50 text-hover-danger" data-toggle="pill" href="#">
                                                            <span class="nav-icon py-2 w-auto">
                                                                <span class="svg-icon svg-icon-9x">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 460 460" style="enable-background:new 0 0 460 460;" xml:space="preserve">
                                                                        <g>
                                                                            <path style="fill:#E30423;" d="M230,0C102.974,0,0,102.974,0,230c0,101.638,65.927,187.878,157.35,218.291l290.261-292.95   C416.611,64.962,330.892,0,230,0z"/>
                                                                            <path style="fill:#c0051e;" d="M460,230c0-26.134-4.368-51.246-12.398-74.657l-99.177-99.177l-236.184,347l45.113,45.113   C180.19,455.876,204.612,460,230,460C357.025,460,460,357.025,460,230z"/>
                                                                            <polygon style="fill:#C2FBFF;" points="309.061,83.157 269.684,56.167 230.333,83.157 198.113,245.77 230.333,376.176    269.684,403.167 309.061,376.176 348.425,403.167 348.425,56.167  "/>
                                                                            <polygon style="fill:#FFFFFF;" points="190.969,56.167 151.605,83.157 112.241,56.167 112.241,403.167 151.605,376.176    190.969,403.167 230.333,376.176 230.333,83.157  "/>
                                                                            <rect x="288.425" y="234.667" style="fill:#1F2044;" width="30" height="20"/>
                                                                            <rect x="288.425" y="194.667" style="fill:#1F2044;" width="30" height="20"/>
                                                                            <rect x="288.425" y="314.667" style="fill:#1F2044;" width="30" height="20"/>
                                                                            <rect x="288.425" y="274.667" style="fill:#1F2044;" width="30" height="20"/>
                                                                            <rect x="142.241" y="274.667" style="fill:#366796;" width="88.092" height="20"/>
                                                                            <rect x="142.241" y="234.667" style="fill:#366796;" width="88.092" height="20"/>
                                                                            <rect x="142.241" y="194.667" style="fill:#366796;" width="88.092" height="20"/>
                                                                            <polygon style="fill:#5488A8;" points="230.333,124.667 210.333,144.667 230.333,164.667 318.425,164.667 318.425,124.667  "/>
                                                                            <rect x="142.241" y="124.667" style="fill:#71E2F0;" width="88.092" height="40"/>
                                                                            <rect x="142.241" y="314.667" style="fill:#366796;" width="88.092" height="20"/>
                                                                        </g>
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                            <span style="font-size: 1rem;" class="nav-text font-size-lg py-2 font-weight-bold text-center">Template {{$i}}</span>
                                                        </a>
                                                    </li>
                                                    <!--end::Item-->
                                                @endfor
                                            
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title" data-toggle="collapse" data-target="#collapseOne2">
                                            Saved Templates
                                        </div>
                                    </div>
                                    <div id="collapseOne2" class="collapse show" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            <ul class="row m-0 p-0" role="tablist">
                                                <!--begin::Item-->
                                                    <li class="d-flex col-sm-2 mb-3">
                                                        <a class="nav-link border py-4 d-flex flex-grow-1 rounded flex-column align-items-center text-dark-50 text-hover-danger" data-toggle="pill" href="#">
                                                            <span class="nav-icon py-2 w-auto">
                                                                <span class="svg-icon svg-icon-9x">
                                                                    <!--begin::Svg Icon -->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24" />
                                                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                                            <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000" />
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                            </span>
                                                            <span style="font-size: 1rem;" class="nav-text font-size-lg font-weight-bold text-center">Add New</span>
                                                        </a>
                                                    </li>
                                                <!--end::Item-->
                                                @foreach ($invoices as $invoice)
                                                    <!--begin::Item-->
                                                        <li class="d-flex col-sm-2 mb-3">
                                                            <form action="{{route('invoice.invoice-data', $invoice->id)}}" id="{{'invoice'.$invoice->id}}" method="POST">
                                                                @csrf
                                                            </form>
                                                            <a class="nav-link border py-4 d-flex flex-grow-1 rounded flex-column align-items-center text-dark-50 text-hover-danger" data-toggle="pill" href="#" onclick="document.getElementById('invoice{{$invoice->id}}').submit()">
                                                                <span class="nav-icon py-2 w-auto">
                                                                    <span class="svg-icon svg-icon-9x">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 460 460" style="enable-background:new 0 0 460 460;" xml:space="preserve">
                                                                            <g>
                                                                                <path style="fill:#E30423;" d="M230,0C102.974,0,0,102.974,0,230c0,101.638,65.927,187.878,157.35,218.291l290.261-292.95   C416.611,64.962,330.892,0,230,0z"/>
                                                                                <path style="fill:#c0051e;" d="M460,230c0-26.134-4.368-51.246-12.398-74.657l-99.177-99.177l-236.184,347l45.113,45.113   C180.19,455.876,204.612,460,230,460C357.025,460,460,357.025,460,230z"/>
                                                                                <polygon style="fill:#C2FBFF;" points="309.061,83.157 269.684,56.167 230.333,83.157 198.113,245.77 230.333,376.176    269.684,403.167 309.061,376.176 348.425,403.167 348.425,56.167  "/>
                                                                                <polygon style="fill:#FFFFFF;" points="190.969,56.167 151.605,83.157 112.241,56.167 112.241,403.167 151.605,376.176    190.969,403.167 230.333,376.176 230.333,83.157  "/>
                                                                                <rect x="288.425" y="234.667" style="fill:#1F2044;" width="30" height="20"/>
                                                                                <rect x="288.425" y="194.667" style="fill:#1F2044;" width="30" height="20"/>
                                                                                <rect x="288.425" y="314.667" style="fill:#1F2044;" width="30" height="20"/>
                                                                                <rect x="288.425" y="274.667" style="fill:#1F2044;" width="30" height="20"/>
                                                                                <rect x="142.241" y="274.667" style="fill:#366796;" width="88.092" height="20"/>
                                                                                <rect x="142.241" y="234.667" style="fill:#366796;" width="88.092" height="20"/>
                                                                                <rect x="142.241" y="194.667" style="fill:#366796;" width="88.092" height="20"/>
                                                                                <polygon style="fill:#5488A8;" points="230.333,124.667 210.333,144.667 230.333,164.667 318.425,164.667 318.425,124.667  "/>
                                                                                <rect x="142.241" y="124.667" style="fill:#71E2F0;" width="88.092" height="40"/>
                                                                                <rect x="142.241" y="314.667" style="fill:#366796;" width="88.092" height="20"/>
                                                                            </g>
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                                <span style="font-size: 1rem;" class="nav-text font-size-lg py-2 font-weight-bold text-center">{{$invoice->invoice_title}}</span>
                                                            </a>
                                                        </li>
                                                    <!--end::Item-->
                                                    
                                                @endforeach
                                            
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
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
    {{-- <script src="{{asset('js/pages/custom/wizard/wizard-3.js?v=7.2.9')}}"></script> --}}
    <script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datetimepicker.js')}}"></script>
@endsection