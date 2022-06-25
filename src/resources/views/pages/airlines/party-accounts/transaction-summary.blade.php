@extends('layout.default')
@section('title', 'Transaction Summary')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Party Transaction</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('party-accounts.index') }}" class="text-muted">All Transaction</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Transaction Summary</a>
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
                    <div class="card mb-5">
                        <form action="{{ route('party-transactions.filter') }}" method="post">
                            @csrf
                            <div class="card-body d-flex flex-column p-5">
                                <div class="form-group row mb-1">
                                    <div class="col-xl-5">
                                        <div class="form-group mb-0">
                                            <label for="">Select Date</label>
                                            <input type="text" id="daterangepicker" readonly
                                                value="{{ request()->date_range != '' ? request()->date_range : '' }}"
                                                class="form-control  " name="date_range" placeholder="Select Date">
                                        </div>
                                    </div>
                                    <div class="col-xl-5">
                                        <div class="form-group mb-0">
                                            <label for="">Party</label>
                                            <select name="party_id" class="form-control selectpicker"
                                                data-live-search="true" data-size="5" title="Select Party" id="">
                                                @foreach ($parties as $id => $party)
                                                    <option value="{{ $id }}"
                                                        {{ request()->party_id == $id ? 'selected' : '' }}>
                                                        {{ $party }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-2">
                                        <button class="btn btn-primary btn-shadow btn-lg mt-8 px-12"
                                            type="submit">Search</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">Transaction Summary
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Accounts</span> -->
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                @if (!Auth::guard('web')->check())
                                    @can('party_account_create')
                                        <!--begin::Button-->
                                        <a href="{{ route('party-accounts.create') }}"
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
                                            </span>New Transaction</a>
                                        <!--end::Button-->
                                    @endcan
                                @else
                                    <a href="{{ route('party-accounts.create') }}"
                                        class="btn btn-primary mx-2 font-weight-bolder">
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
                                        </span>New Transaction</a>
                                    <!--end::Button-->
                                @endif
                                @if (!$party_transactions->isEmpty())
                                    <!--begin::Dropdown-->
                                    <div class="dropdown dropdown-inline mr-2">
                                        <button type="button"
                                            class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="svg-icon svg-icon-md">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                                            fill="#000000" opacity="0.3" />
                                                        <path
                                                            d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                                            fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>Export</button>
                                        <!--begin::Dropdown Menu-->
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <!--begin::Navigation-->
                                            <ul class="navi flex-column navi-hover py-2">
                                                <li
                                                    class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                                    Choose an option:</li>
                                                <li class="navi-item">
                                                    @php
                                                        $filter_data = [
                                                            'party_id' => request()->party_id,
                                                            'date_range' => request()->date_range,
                                                        ];
                                                    @endphp
                                                    <a href="{{ route('print.party-transactions', $filter_data) }}"
                                                        target="_blank" class="navi-link">

                                                        <span class="navi-icon">
                                                            <i class="la la-print"></i>
                                                        </span>
                                                        <span class="navi-text">Print</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" id="export_copy" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="la la-copy"></i>
                                                        </span>
                                                        <span class="navi-text">Copy</span>
                                                    </a>
                                                </li>
                                                {{-- <li class="navi-item">
                                                    <a href="#" id="export_excel" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="la la-file-excel-o"></i>
                                                        </span>
                                                        <span class="navi-text">Excel</span>
                                                    </a>
                                                </li> --}}
                                                <li class="navi-item">
                                                    <a href="#" id="export_csv" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="la la-file-text-o"></i>
                                                        </span>
                                                        <span class="navi-text">CSV</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    @php
                                                        $filter_data = [
                                                            'party_id' => request()->party_id,
                                                            'date_range' => request()->date_range,
                                                        ];
                                                    @endphp
                                                    <a href="{{ route('print.party-transactions', $filter_data) }}"
                                                        target="_blank" class="navi-link">

                                                        <span class="navi-icon">
                                                            <i class="la la-file-pdf-o"></i>
                                                        </span>
                                                        <span class="navi-text">PDF</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                        <!--end::Dropdown Menu-->
                                    </div>
                                    <!--end::Dropdown-->
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-separate table-head-custom nowrap table-checkable"
                                id="transaction_table">
                                <thead>
                                    <tr>
                                        <th data-priority="1">Transaction Date</th>
                                        <th>Description</th>
                                        <th>Ammount</th>
                                        <th>Transaction Type</th>
                                        <th data-priority="2">Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$party_transactions->isEmpty())
                                        @foreach ($party_transactions as $party_transaction)
                                            <tr>

                                                <td>{{ date('D, d M Y', strtotime($party_transaction->payment_date)) }}
                                                </td>
                                                <td>{{ substr($party_transaction->description, 0, 40) }}...</td>
                                                <td>{{ $party_transaction->amount }}</td>
                                                <td>{{ ucfirst($party_transaction->payment_type_title) }}</td>
                                                <td>{{ $party_transaction->balance }}</td>

                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                                @if (!$party_transactions->isEmpty())
                                    <tr>
                                        <td class="font-weight-bolder">
                                            {{ date('D, d M Y', strtotime($party_transactions->last()->payment_date)) }}
                                        </td>
                                        <td class="font-weight-bolder">Closing Balance</td>
                                        <td></td>
                                        <td></td>
                                        <td class="font-weight-bolder">{{ $party_transactions->last()->balance }}</td>
                                    </tr>
                                @endif

                            </table>
                            <!--end: Datatable-->
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

{{-- Styles Section --}}
<!-- @section('styles')
                    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection -->


{{-- Scripts Section --}}

@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5') }}"></script>
    <script src="{{ asset('js/pages/crud/datatables/basic/paginations.js?v=7.0.5') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/widgets/rangepicker.js') }}"></script>
@endsection
