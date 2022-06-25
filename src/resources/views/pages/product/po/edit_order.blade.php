@extends('layout.default')
@section('title', 'Edit Purchase Order')
@section('styles')
@livewireStyles
<link rel="stylesheet" href="{{asset('css/pages/flatpicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/flatpicker-theme.css')}}">
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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Product</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="#" class="text-muted">Inventory Purchase Orders</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('purchase-orders.index')}}" class="text-muted">Purchase Orders</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#" class="text-muted">Edit Purchase Order</a>
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
                    @livewire('edit-purchase-order')
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
@livewireScripts
{{--vendors--}}
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5')}}"></script>

{{-- Products Data --}}
<script src="{{asset('js/pages/crud/datatables/basic/scrollable.js?v=7.0.5')}}"></script>

{{-- Date Picker --}}
<script src="{{ asset('js/pages/flatpicker.js') }}"></script>
{{--Custom JS--}}

<script src="{{asset('js/po/form_validation.js')}}"></script>
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-select.js')}}"></script>
<script>
    window.addEventListener('hide-modal', event => {
        $('#supplier_model').modal('hide');
    });
    window.addEventListener('success', event => {
        toastr.error("Purchase order added");

    });
    // window.livewire.on('alert', param => {
    //     toastr[param['type']](param['message']);
    // });

    $(".flatpickr").flatpickr({
        defaultDate: "today",
    });
</script>

@endsection