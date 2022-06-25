@extends('layout.default')
@section('title', 'Settings')
@section('content')


    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Settings</h5>
                    <!--end::Page Title-->
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
                        <div class="card-body">
                            @php
                                $premium = DB::table('subscriptions')
                                    ->where('outlet_id', session('outlet_id'))
                                    ->where('subscription_status', 'verified')
                                    ->whereDate('subscription_start_date', '<=', Carbon\Carbon::today()->format('Y-m-d h:i:s'))
                                    ->whereDate('subscription_end_date', '>=', Carbon\Carbon::today()->format('Y-m-d h:i:s'))
                                    ->first();
                            @endphp
                            <div class="row">
                                <div class="col-xl-3 py-3 bg-dark rounded-left">
                                    <div class="nav flex-column nav-pills nav-danger" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <a class="nav-link active font-weight-bolder" id="v-pills-outlet-tab"
                                            data-toggle="pill" href="#v-pills-outlet" role="tab"
                                            aria-controls="v-pills-outlet" aria-selected="true">Outlet</a>
                                        <a class="nav-link font-weight-bolder" id="v-pills-pos-settings-tab"
                                            data-toggle="pill" href="#v-pills-pos-settings" role="tab"
                                            aria-controls="v-pills-pos-settings" aria-selected="true">POS Setting</a>
                                        <a class="nav-link font-weight-bolder" id="v-pills-payment-type-tab"
                                            data-toggle="pill" href="#v-pills-payment-type" role="tab"
                                            aria-controls="v-pills-payment-type" aria-selected="false">Payment Types</a>
                                        <a class="nav-link font-weight-bolder" id="v-pills-payment-method-tab"
                                            data-toggle="pill" href="#v-pills-payment-method" role="tab"
                                            aria-controls="v-pills-payment-method" aria-selected="false">Payment Methods</a>
                                        @if ($premium)
                                            <a class="nav-link font-weight-bolder" id="v-pills-subscription-tab"
                                                data-toggle="pill" href="#v-pills-subscription" role="tab"
                                                aria-controls="v-pills-subscription" aria-selected="false">Subscription</a>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-xl-9 border rounded-right" style="height:500px; overflow-y:auto;">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        @include(
                                            'pages.settings.tab-content.outlet-pane'
                                        )
                                        @include(
                                            'pages.settings.tab-content.pos-settings-pane'
                                        )
                                        @include(
                                            'pages.settings.tab-content.payment-type-pane'
                                        )
                                        @include(
                                            'pages.settings.tab-content.payment-method-pane'
                                        )
                                        @if ($premium)
                                            @include(
                                                'pages.settings.tab-content.subscription-pane'
                                            )
                                        @endif
                                        {{-- <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                            aria-labelledby="v-pills-settings-tab">...</div> --}}
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
    <form action="" name="delete_payment" id="delete_payment" method="post">
        @csrf
        @method('DELETE')
    </form>



@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('a[data-toggle="pill"]').on('show.bs.tab', function(e) {
                // console.log($(e.target).attr('href'));
                localStorage.setItem('settingActiveTab', $(e.target).attr('href'));
            });
            var settingActiveTab = localStorage.getItem('settingActiveTab');
            if (settingActiveTab) {
                $('#v-pills-tab a[href="' + settingActiveTab + '"]').tab('show');
            }
        });
        $('#btn-submit').click(() => {
            var outlet_title = $('#outlet_title').val();
            $('#outlet_title').val(outlet_title.trim());
            var outlet_phone = $('#outlet_phone').val();
            $('#outlet_phone').val(outlet_phone.trim());
        });
    </script>
    <script>
        $('#country').change(function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    url: "{{ url('get-state') }}?country_id=" + countryID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            $("#state").empty();
                            $("#state").append('<option value="">Select State</option>');
                            $("#city").empty();
                            $("#city").append('<option value="">Select City</option>');
                            $.each(res, function(key, value) {
                                $("#state").append('<option value="' + value + '">' + key +
                                    '</option>');
                            });

                        } else {
                            $("#state").empty();
                            $("#state").append('<option value="">Select country first</option>');
                            $("#city").empty();
                            $("#city").append('<option value="">Select State first</option>');
                        }
                    }
                });
            } else {
                $("#state").empty();
                $("#state").append('<option value="">Select country first</option>');
                $("#city").empty();
                $("#city").append('<option value="">Select State first</option>');
            }
        });
        $('#state').change(function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    url: "{{ url('get-city') }}?state_id=" + stateID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            $("#city").empty();
                            $("#city").append('<option value="">Select City</option>');
                            $.each(res, function(key, value) {
                                $("#city").append('<option value="' + value + '">' + key +
                                    '</option>');
                            });

                        } else {
                            $("#city").empty();
                            $("#city").append('<option value="">Select State first</option>');
                        }
                    }
                });
            } else {
                $("#city").empty();
                $("#city").append('<option value="">Select State first</option>');
            }
        });
    </script>
    <script src="{{ asset('js/outlets/form_validation.js') }}"></script>

    <script>
        function deleteMethod(data) {
            data = jQuery.parseJSON(data);
            $('#delete_payment').attr("action", "payment-methods/" + data);
            $('#delete_payment').submit();
        }
    </script>
@endsection
