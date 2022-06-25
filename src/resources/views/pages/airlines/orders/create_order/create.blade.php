@extends('layout.default-sales')
@section('title', 'Add Outlet Discount')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/airlines/order.css') }}">
@endsection
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid mt-15 px-md-5">
        <!--begin::Container-->
        <div class="container-fluid  px-0">
            <!--begin::Teachers-->
            <div class="d-flex flex-row">
                <!--begin::Content-->
                <div class="flex-row-fluid">
                    <form action="#" class="" id="orderForm">

                        <div class="row overlay-wrapper">
                            <div class="col-md-8 col-12">
                                {{-- Order Information --}}
                                @include(
                                    'pages.airlines.orders.create_order._partials.order_information'
                                )
                                {{-- Ticket Details --}}
                                @include(
                                    'pages.airlines.orders.create_order._partials.ticket_details'
                                )
                                {{-- Order Total --}}
                                @include(
                                    'pages.airlines.orders.create_order._partials.order_total'
                                )
                            </div>
                            <div class="col-md-4 col-12">
                                {{-- Ticket Price and taxes --}}
                                @include(
                                    'pages.airlines.orders.create_order._partials.ticket_price'
                                )

                                {{-- Discount --}}
                                @include(
                                    'pages.airlines.orders.create_order._partials.discount'
                                )

                                {{-- Commission --}}
                                @include(
                                    'pages.airlines.orders.create_order._partials.commission'
                                )

                                <div class="d-flex justify-content-center mb-3">
                                    <button id="add-discount" type="button" class="btn btn-dark btn-sm mx-1">
                                        Add Discount
                                    </button>

                                    <button id="add-commission" type="button" class="btn btn-dark btn-sm mx-1">
                                        Add Commission
                                    </button>

                                </div>
                            </div>
                        </div>
                        <div class="overlay-layer rounded bg-dark-o-50" style="z-index: 3; position: fixed; display:none;">

                            <div class="alert alert-custom alert-light fade show mb-5" role="alert">
                                <div class="alert-icon">
                                    <div class="spinner spinner-primary spinner-track"></div>
                                </div>
                                <div class="alert-text ml-5">Please Wait...</div>
                            </div>
                        </div>
                    </form>
                    <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" data-backdrop="static">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                        onclick="location.reload()">Close</button>
                                    <button type="button" class="btn btn-primary font-weight-bold">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end::Content-->
            </div>
            <!--end::Teachers-->
        </div>
        <!--end::Container-->
    </div>

    <!-- Modal-->
    @include(
        'pages.airlines.orders.create_order._partials.new_commission_modal'
    )

    <!--end::Entry-->
@endsection


{{-- Scripts Section --}}

@section('scripts')
    <script>
        var ADD_PARTY_URL = "{{ route('parties.add-party') }}";
        var GET_PARTY_URL = "{{ url('get-party') }}";
        var GET_TAX_URL = "{{ url('get-tax') }}";
        var GET_DISCOUNT_URL = "{{ url('get-discount') }}";
        var GET_COMMISSION_URL = "{{ url('get-commission') }}";
        var ADD_COMMISSION_URL = "{{ route('outlet-commissions.add-commission') }}";
    </script>
    <script src="{{ asset('js/airlines/form_validation.js') }}"></script>
    <script src="{{ asset('js/airlines/order_calculations2.js') }}"></script>
    <script src="{{ asset('js/airlines/order.js') }}"></script>
    <script src="{{ asset('js/airlines/save_order.js') }}"></script>
    <script>
        $('#btn-submit').click(() => {
            var commission_title = $('#commission_title').val();
            $('#commission_title').val(commission_title.trim());
        });
    </script>
    <script src="{{ asset('js/airlines/commissions/form_validation_modal.js') }}"></script>

@endsection
