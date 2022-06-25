@extends('layout.default-outlets')
@section('title', 'Outlets')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid w-100 py-0" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Outlets</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">Manage Outlet</a>
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
        <div class="container mt-xl-20 px-5 py-0">
            <div class="col-xl-4 pl-md-0">
                <div class="alert alert-primary">
                    {{ count($outlets) > 0 ? 'Please click on the outlet' : 'Please click to add outlet' }}</div>
            </div>
            <div class="row">
                @foreach ($outlets as $outlet)
                    @php
                        $premium = DB::table('subscriptions')
                            ->where('outlet_id', $outlet->id)
                            ->where('subscription_status', 'verified')
                            ->whereDate('subscription_start_date', '<=', Carbon\Carbon::today()->format('Y-m-d h:i:s'))
                            ->whereDate('subscription_end_date', '>=', Carbon\Carbon::today()->format('Y-m-d h:i:s'))
                            ->first();
                    @endphp

                    @php
                        $class = '';
                        $outlet_link = '';
                        if ($outlet->status_value == 1) {
                            $class = 'bg-success';
                            $outlet_link = 'outlets/open-outlet?outlet_id=' . $outlet->id . '&outlet_title=' . urlencode($outlet->outlet_title) . '&outlet_phone=' . Crypt::encrypt($outlet->outlet_phone) . '&outlet_address=' . Crypt::encrypt($outlet->outlet_address);
                        } elseif ($outlet->status_value == 2) {
                            $class = 'bg-warning';
                            $outlet_link = '#';
                        } elseif ($outlet->status_value == 3) {
                            $class = 'bg-danger';
                            $outlet_link = '#';
                        }
                    @endphp
                    <div class="col-xl-4 col-sm-6"
                        onclick="{{ $outlet->outlet_status_id != 1 ? 'report(' . $outlet->id . ')' : '' }}">
                        <div class="card mb-6">
                            <a href="{{ $outlet_link }}" class="text-dark">


                                <div class="card-body ribbon ribbon-right">
                                    <div class="ribbon-target {{ $class }}" style="top: 10px; right: -2px;">
                                        {{ $outlet->outlet_status }}</div>

                                    <div class="d-flex align-items-start">

                                        <div class="flex-grow-1 align-self-center mt-3">
                                            <div class="border-bottom pb-1">
                                                <h5 class="font-size-16 mb-3">
                                                    @if ($premium)
                                                        <i class="fas fa-crown text-warning font-size-md"></i>
                                                    @endif
                                                    {{ $outlet->outlet_title }}
                                                </h5>
                                                <p class="text-muted">
                                                    <i class="fas fa fa-map-marker-alt mr-1"></i>
                                                    {{ $outlet->outlet_address ?? $outlet->city_name }}
                                                </p>

                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mt-3">
                                                        <p class="text-muted mb-2">Products</p>
                                                        <h5 class="font-size-16 mb-0">
                                                            {{ Auth::guard('employee')->check() ? $products : count($outlet->products) }}
                                                        </h5>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-6">
                                                <div class="mt-3">
                                                    <p class="text-muted mb-2">Wallet Balance</p>
                                                    <h5 class="font-size-16 mb-0">$9,852</h5>
                                                </div>
                                            </div> --}}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
                @if (Auth::guard('web')->check())
                    <div class="col-xl-4 col-sm-6">
                        <div class="card mb-6">
                            <a href="{{ route('outlets.create') }}" class="text-dark">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1 align-self-center">
                                            <div class="row justify-content-center pb-2">
                                                <span class="svg-icon svg-success svg-icon-6x">
                                                    <svg width="230" height="228" viewBox="0 0 230 228" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M85 144.369V228H145V144.632L228.868 145L229.132 85.0003L145 84.6313V0H85V84.3681L1.13158 84.0003L0.868408 144L85 144.369Z"
                                                            fill="#CFCFCF" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mt-3">
                                                        <p class="text-muted mb-2 text-center">Create New Outlet</p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
        <!--end::Entry-->
    </div>


    <!-- Report MODEL -->
    <div class="modal fade" id="ticket_model" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="add_ticket_form" class="add_ticket">

                    <div class="modal-header p-4">
                        <h6 class="modal-title" id="ticket_model">Add Ticket</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="alert alert-custom alert-default py-3" role="alert">
                                <div class="alert-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-xl">
                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Info-circle.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1" />
                                                <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <div class="alert-text">You are not allowed to access this outlet. If you are not aware
                                    of this report here.</div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-xl-12">
                                <div class="form-group mb-5">
                                    <label>Title*</label>
                                    <input type="text" class="form-control" autofocus name="title" placeholder="Title" />

                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group mb-5">
                                    <label>Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>

                                </div>
                            </div>

                        </div>


                        <input type="hidden" name="outlet_id" id="outlet_id">
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                        <button class="btn btn-primary btn-shadow px-12 mt-4" id="save-ticket">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        localStorage.removeItem('settingActiveTab');

        function report(id) {
            $('#outlet_id').val(id);
            $('#ticket_model').modal('toggle');
        }

        $("#save-ticket").on("click", function(event) {
            event.preventDefault();
            // console.log($('#description').val());
            $("#save-ticket").attr("disabled", true);
            let _token = $('meta[name="csrf-token"]').attr("content");
            let title = $("input[name=title]").val();
            let description = $('#description').val();
            let created_by = $("input[name=created_by]").val();
            let outlet_id = $('#outlet_id').val();
            // data = document.getElementById("add_customer_form"),
            $.ajax({
                url: "{{ route('tickets.add-ticket-ajax') }}",
                type: "POST",
                data: {
                    title: title,
                    description: description,
                    created_by: created_by,
                    outlet_id: outlet_id,
                    _token: _token,
                },
                success: function(response) {
                    console.log(response);
                    $("#ticket_model").modal("toggle");
                    $("#save-ticket").attr("disabled", false);
                    toastr.success(response.success);
                    $("[name='title']").val("");
                    $("#description").val("");
                    $("#outlet_id").val("");
                    // $("#save-category").attr("disabled", false);
                    // $("[name='category_title']").val("");
                },
                error: function(response) {
                    console.log(response);
                    $("#ticket_model").modal("toggle");
                    $("#save-ticket").attr("disabled", false);
                    toastr.error("Error! Please try again");
                    $("[name='title']").val("");
                    $("#description").val("");
                    $("#outlet_id").val("");
                },
            });
        });
    </script>
@endsection
