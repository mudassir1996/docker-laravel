@extends('layout.default')
@section('title', 'Create Ticket')
@section('content')


    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Support Tickets</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('tickets.index') }}" class="text-muted">All Tickets</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Create Ticket</a>
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
            <!--begin::Section-->
            <div class="text-center py-10">
                <h1 class="h2 font-weight-bolder text-dark mb-6">Looking for Help?</h1>
                <div class="h4 text-dark-50 font-weight-normal">Submit your help request to one of our MgtOS Experts!</div>
            </div>
            <!--end::Section-->
            <!--begin::Card-->
            <div class="card card-custom gutter-b">

                <!--begin::Form-->

                <form class="form" action="{{ route('tickets.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3"></div>
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control   @error('title') is-invalid @enderror"
                                        placeholder="Enter title" value="{{ old('title') }}" name="title">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!--end::Input-->

                                <!--begin::Input-->
                                <div class="form-group">
                                    <label for="exampleTextarea">Description</label>
                                    <textarea name="description" class="form-control  " id="exampleTextarea"
                                        rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!--end::Input-->

                                <div class="image-input image-input-outline" id="kt_image_1">
                                    <div class="image-input-wrapper"
                                        style="background-image: url({{ asset('storage/placeholder.jpg') }}); width: 200px; height: 200px;">
                                    </div>

                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="featured_img" accept=".jpg,.png" />
                                        {{-- <input type="hidden" name="profile_avatar_remove"/> --}}
                                    </label>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                                @error('featured_img')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                {{-- {{Auth::user()->employee_id}} --}}
                                <input type="hidden" name="status" value="open">
                                <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                <input type="hidden" name="created_by" value="{{ session('employee_id') }}">

                            </div>

                        </div>
                    </div>
                    <!--begin::Actions-->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-xl-3"></div>
                            <div class="col-xl-6">
                                <button type="submit" class="btn btn-primary font-weight-bold mr-2">Submit</button>
                                <button type="reset" class="btn btn-clean font-weight-bold">Cancel</button>
                            </div>
                            <div class="col-xl-3"></div>
                        </div>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-6">
                    <!--begin::Callout-->
                    <div class="card card-custom mb-2 bg-diagonal bg-diagonal-light-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between p-4">
                                <!--begin::Content-->
                                <div class="d-flex flex-column mr-5">
                                    <a href="#" class="h4 text-dark mb-5">Contact Us</a>
                                    <p class="text-dark-50">Click the next button and submit your query
                                        <br>our expert will reply back as soon as possible.
                                    </p>
                                </div>
                                <!--end::Content-->
                                <!--begin::Button-->
                                <div class="ml-6 flex-shrink-0">
                                    <a href="#" data-toggle="modal" data-target="#kt_chat_modal"
                                        class="btn font-weight-bolder text-uppercase font-size-lg btn-primary py-3 px-6">Contact
                                        Us</a>
                                </div>
                                <!--end::Button-->
                            </div>
                        </div>
                    </div>
                    <!--end::Callout-->
                </div>
                <div class="col-lg-6">
                    <!--begin::Callout-->
                    <div class="card card-custom mb-2 bg-diagonal bg-diagonal-light-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between p-4">
                                <!--begin::Content-->
                                <div class="d-flex flex-column mr-5">
                                    <a href="#" class="h4 text-dark mb-5">Schedule A Call</a>
                                    <p class="text-dark-50">
                                        Select your preferable time <br> and our expert will call you.
                                    </p>
                                </div>
                                <!--end::Content-->
                                <!--begin::Button-->
                                <div class="ml-6 flex-shrink-0">
                                    <a href="#" data-toggle="modal" data-target="#kt_chat_modal"
                                        class="btn font-weight-bolder text-uppercase font-size-lg btn-success py-3 px-6">Schedule
                                        A Call</a>
                                </div>
                                <!--end::Button-->
                            </div>
                        </div>
                    </div>
                    <!--end::Callout-->
                </div>
            </div>
            <!--end::Row-->
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
    <script>
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
    <script src="{{ asset('js/suppliers/form_validation.js') }}"></script>
    {{-- <script>
    KTApp.block('#kt_blockui_content', {
  overlayColor: '#000000',
  state: 'danger',
  message: 'Please wait...'
 });

 setTimeout(function() {
  KTApp.unblock('#kt_blockui_content');
 }, 2000);
</script> --}}


@endsection
