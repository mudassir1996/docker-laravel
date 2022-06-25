@extends('layout.default')
@section('title', 'Zakat Calculator')
@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Zakat Calculator</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        {{-- <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Daily Summary Report</a>
                        </li> --}}
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->

        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid px-0">
            <!--begin::Teachers-->
            <div class="d-flex flex-row justify-content-center">

                <div class="col-xl-8">
                    <div class="card card-custom bgi-no-repeat"
                        style="height:250px; background-position: 100% 50%; background-size: 100%; background-image: url({{ asset('media/bg/zakat-bg-2.jpg') }})">
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-center">
                            <div>
                                {{-- <h1 class="text-white font-weight-bolder">
                                    Zakat Calculator
                                </h1> --}}
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-center">
                <div class="col-xl-8">
                    <div class="card card-custom gutter-b card-stretch">

                        <!--begin::Items-->
                        <div class="flex-grow-1 card-spacer-x card-spacer-y">

                            <!--begin::Item-->
                            <div class="d-flex align-items-center justify-content-between mb-10">
                                <div class="d-flex align-items-center mr-2">

                                    <div>
                                        <p class="font-size-h2 text-dark-75 mb-0 font-weight-bolder">
                                            Total Retail
                                        </p>
                                        <div class="font-size-sm text-muted font-weight-bold mt-1">
                                            Sum of retail price of a product x its available quantity
                                        </div>

                                    </div>
                                </div>
                                <div class="font-weight-bolder font-size-h2">
                                    PKR {{ App\Classes\CurrencyFormatter::get($total_retail) }}
                                </div>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center mr-2">

                                    <div>
                                        <p class="font-size-h2 text-dark-75 mb-0 font-weight-bolder">
                                            Total Zakat
                                        </p>
                                        <div class="font-size-sm text-muted font-weight-bold mt-1">
                                            Total Retail / 40
                                        </div>
                                    </div>
                                </div>
                                <div class="font-weight-bolder font-size-h2">
                                    PKR {{ App\Classes\CurrencyFormatter::get($total_zakat) }}</div>
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Items-->

                    </div>

                </div>
            </div>
            <!--end::Teachers-->
        </div>
        <!--end::Container-->
    </div>







@endsection

@section('scripts')
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
@endsection
