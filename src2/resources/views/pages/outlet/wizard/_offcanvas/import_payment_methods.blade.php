<div class="offcanvas offcanvas-right p-10 pb-20" id="kt_offcanvas_payment_method">
    <div class="offcanvas-header pb-3">
        <div class="d-flex align-items-center justify-content-between mb-5">
            <h3 class="font-weight-bold m-0">
                Payment Methods
            </h3>
            {{-- <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_offcanvas_payment_method_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a> --}}
            <button type="button" class="btn btn-primary" data-checked="0" id="select-all-payment-methods">Select
                All</button>
        </div>
        {{-- <div class="d-flex flex-center py-2 px-6 bg-light rounded">
            <span class="svg-icon svg-icon-lg svg-icon-primary">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Search.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path
                            d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                        <path
                            d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                            fill="#000000" fill-rule="nonzero"></path>
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
            <input type="text" id="searchbar" class="form-control border-0 font-weight-bold pl-2 bg-light"
                placeholder="Search Category">
        </div> --}}

    </div>
    <div class="offcanvas-content pt-3 mr-n5">
        <div class="row">
            <div class="col-xl-12">
                {{-- <!--begin::Item-->
                <div class="d-flex align-items-center mb-6 no-categories">
                    <div class="d-flex flex-column flex-grow-1 py-2 ml-4">
                        <a href="#" class="text-muted font-weight-bold font-size-lg mb-1">No Categories Found</a>
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Item--> --}}
                @foreach ($standard_payment_methods as $standard_payment_method)
                    <!--begin::Item-->
                    <div class="d-flex align-items-center mb-6 payment_methods">
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 py-2 ml-4">
                            <a href="#"
                                class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1 payment-method-title">{{ $standard_payment_method->payment_title }}</a>
                        </div>
                        <!--end::Text-->
                        <!--begin::Checkbox-->
                        <label class="checkbox checkbox-lg checkbox-primary flex-shrink-0 m-0 mr-4">
                            <input type="checkbox" name="payment_methods[]" class="payment-method-check"
                                value="{{ $standard_payment_method->id }}">
                            <span></span>
                        </label>
                        <!--end::Checkbox-->
                    </div>
                    <!--end::Item-->
                @endforeach


            </div>


        </div>
        {{-- <div class="row">
        </div> --}}
    </div>
    {{-- <div class="offcanvas-footer text-center">
        <button type="button" class="btn btn-primary" data-checked="0" id="select-all-payment-methods">Select
            All</button>
    </div> --}}

</div>
