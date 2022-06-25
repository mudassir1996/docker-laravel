@extends('layout.default')
@section('title', 'Orders')
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        div.dataTables_wrapper div.dataTables_processing {
            background: #e3fffe !important;
        }

        .form-group label {
            font-size: 0.9rem;
        }

        .bootstrap-select .bs-searchbox {
            padding: 0.2rem;
        }

        .bs-searchbox .form-control {
            padding: 0.2rem;
            height: 50%;
        }

        .bootstrap-select .dropdown-menu.inner>li>a {
            padding: 0.4rem;
        }

        .bootstrap-select .dropdown-menu.inner>li>a:hover {
            background: #ebedf3;
        }

        .bootstrap-select .dropdown-menu.inner>li.selected>a {
            background: #ebedf3;
        }

        .bootstrap-select>.dropdown-toggle.btn-light,
        .bootstrap-select>.dropdown-toggle.btn-secondary {
            padding: 0.3rem 0.4rem !important;
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Airline Orders</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">All Orders</a>
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
                                <h3 class="card-label">Airline Orders
                                    <span class="d-block text-muted pt-2 font-size-sm">All Orders</span>
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                @if (!Auth::guard('web')->check())
                                    @can('order_create')
                                        <a type="button" href="{{ route('airline-orders.create') }}"
                                            class="btn btn-primary font-weight-bolder">
                                            <span class="svg-icon svg-icon-md">
                                                <!--begin::Svg Icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                        <path
                                                            d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                            fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            New Order
                                        </a>
                                    @endcan
                                @else
                                    <a type="button" href="{{ route('airline-orders.create') }}"
                                        class="btn btn-primary font-weight-bolder">
                                        <span class="svg-icon svg-icon-md">
                                            <!--begin::Svg Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                    <path
                                                        d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                        fill="#000000" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        New Order
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group row mb-2">
                                    <div class="col-xl-3">
                                        <label for="orderId">Order ID</label>
                                        <input type="text" class="form-control p-2" style="height:30px;"
                                            autocomplete="new-id" id="orderId" placeholder="Order ID">
                                    </div>
                                    <div class="col-xl-3">
                                        <label for="ticketNumber">Ticket #</label>
                                        <input type="text" class="form-control" style="height:30px;" autocomplete="new-id"
                                            id="ticketNumber" placeholder="Ticket #">
                                    </div>
                                    <div class="col-xl-3">
                                        <label for="customerId">Customer</label>
                                        <select id="customerId" data-live-search="true" data-size="5"
                                            class="form-control selectpicker">
                                            <option value="">Select</option>
                                            @foreach ($parties as $party)
                                                <option value="{{ $party->id }}">
                                                    {{ $party->party_title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-3">
                                        <label for="supplierId">Supplier/Airline</label>
                                        <select id="supplierId" data-live-search="true" data-size="5"
                                            class="form-control selectpicker">
                                            <option value="">Select</option>
                                            @foreach ($parties as $party)
                                                <option value="{{ $party->id }}">
                                                    {{ $party->party_title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row mb-2">
                                    <div class="col-xl-3">
                                        <label for="orderId">Payment Types</label>
                                        <select id="payment_type_id" data-live-search="true" data-size="5"
                                            class="form-control selectpicker">
                                            <option value="">Select</option>
                                            @foreach ($payment_types as $payment_type)
                                                <option value="{{ $payment_type->id }}">
                                                    {{ $payment_type->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-3">
                                        <label for="category_id">Category</label>
                                        <select id="category_id" data-live-search="true" data-size="5"
                                            class="form-control selectpicker">
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->category_title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-right">
                                    <button type="reset" id="clearFilter" class="btn btn-sm btn-secondary">
                                        <span class="svg-icon">
                                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Close.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                                        fill="#000000">
                                                        <rect x="0" y="7" width="16" height="2" rx="1" />
                                                        <rect opacity="1"
                                                            transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) "
                                                            x="0" y="7" width="16" height="2" rx="1" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        Reset
                                    </button>
                                    <button type="button" id="filter" class="btn btn-sm btn-primary">
                                        <span class="svg-icon">
                                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Search.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="1" />
                                                    <path
                                                        d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                        fill="#000000" fill-rule="nonzero" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        Apply
                                    </button>
                                </div>
                            </form>
                            {{-- @livewire('airlines.order-list') --}}
                            <table class="table table-head-custom nowrap" id="kt_datatable_airline_orders">
                                <thead>
                                    <tr>
                                        <th data-priority="1">Customer</th>
                                        <th>Agent</th>
                                        <th>Category</th>
                                        <th>Recievable</th>
                                        <th>Income</th>
                                        <th>Status</th>
                                        <th>Airline Payable</th>
                                        <th>Other Payable</th>
                                        <th>Total Payable</th>
                                        <th>Total Tax</th>
                                        <th>Total Discount</th>
                                        <th>Total Commission</th>
                                        <th>Total Bill</th>
                                        <th>Amount Paid</th>
                                        <th>Change Back</th>
                                        <th>Payment Type</th>
                                        <th>Payment Method</th>
                                        <th>Remarks</th>
                                        <th>Order Date</th>
                                        <th>Processing Person</th>
                                        <th>Created by</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                    </tr>
                                </thead>
                            </table>
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
    {{-- @livewireScripts --}}
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5') }}"></script>

    {{-- Products Data --}}
    <script src="{{ asset('js/airlines/airline_order_datatable.js') }}"></script>
    <script>
        $('.stop-propagation').on('click', function(e) {
            e.stopPropagation();
        });
        $(function() {
            setTimeout(() => {
                $('[data-toggle="tooltip"]').tooltip()
            }, 1000);
        })
    </script>




@endsection
