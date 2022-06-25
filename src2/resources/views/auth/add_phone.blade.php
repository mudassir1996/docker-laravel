@extends('layout.default-blank')
@section('title', 'Login')
@section('styles')

    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('css/pages/login/login-1.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #D4192C;">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                    <!--begin::Aside header-->
                    <p class="text-center display-2 font-weight-bold mb-10 text-light">
                        <!-- <img src="{{ asset('media/logos/logo-light.png') }}" class="max-h-70px" alt="" /> -->
                        MgtOs
                    </p>
                    <!--end::Aside header-->
                    <!--begin::Aside title-->
                    <h3 class="font-weight-bolder text-center font-size-h5 font-size-h2-lg text-light">Manage Your Business
                        <!-- <br />at one place -->
                    </h3>
                    <!--end::Aside title-->
                </div>
                <!--end::Aside Top-->
                <!--begin::Aside Bottom-->
                @php
                    $side_image = asset('media/svg/illustrations/login-visual-1.svg');
                @endphp
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                    style="background-image: url({{ $side_image }})"></div>
                <!--end::Aside Bottom-->
            </div>
            <!--begin::Aside-->

            <!--begin::Content-->
            <div
                class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-center">
                    <!--begin::Signin-->
                    <div class="login-form login-signin">
                        <!--begin::Title-->
                        <div class="pb-13 pt-lg-0 pt-5">
                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Welcome to MgtOs</h3>
                            <span class="text-muted font-weight-bold font-size-h5">
                                Please add your phone number to get login with phone feature.
                            </span>
                        </div>
                        <!--begin::Title-->
                        <div class="card">
                            <div class="card-header py-3">
                                <div class="row align-items-center">
                                    <div class="col-xl-6 ">
                                        <h4>{{ __('Add Phone Number') }}</h4>
                                    </div>
                                    <div class="col-xl-6 text-right">
                                        <form id="logout-form"
                                            action="{{ auth()->guard('employee')->check()? route('employee.logout'): route('logout') }}"
                                            method="POST">
                                            @csrf
                                            <input type="submit" value="Logout" class="btn btn-dark px-12">
                                        </form>
                                    </div>
                                </div>


                            </div>
                            <div class="card-body">
                                <!--begin::Form-->
                                <form class="form" method="POST" action="{{ route('add-phone.store') }}"
                                    novalidate="novalidate" id="kt_login_signin_form_otp">
                                    @csrf

                                    @error('status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <label class="font-size-h6 font-weight-bolder text-dark">Phone</label>
                                        <input
                                            class="form-control form-control-solid font-size-h6 h-auto py-5 px-6 rounded-lg @error('phone') is-invalid @enderror"
                                            autofocus type="text" name="phone" value="{{ old('phone') }}"
                                            autocomplete="off" placeholder="92**********" />
                                        <small id="error-msg" class="text-danger"></small>
                                        @error('phone')
                                            <div class="fv-plugins-message-container">
                                                <div data-field="phone" data-validator="notEmpty" class="fv-help-block">
                                                    {{ $message }}</div>
                                            </div>
                                        @enderror
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between mt-n5">
                                            <label class="font-size-h6 font-weight-bolder text-dark pt-5">Verification
                                                Code</label>
                                            <div class="spinner-border text-primary mt-5" id="loader"
                                                style="width:20px; height:20px; font-size:11px;" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <a href="javascript:void(0)" id="send-code"
                                                class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">Send
                                                Code</a>
                                            <span
                                                class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5"
                                                id="resend_text">Resend in <span id="timer">2:00</span></span>
                                        </div>


                                        <input
                                            class="form-control form-control-solid font-size-h6 h-auto py-5 px-6 rounded-lg @error('code') is-invalid @enderror"
                                            type="number" name="code" id="code" autocomplete="off"
                                            placeholder="Enter code Here" />
                                        @error('code')
                                            <div class="fv-plugins-message-container">
                                                <div data-field="code" data-validator="notEmpty" class="fv-help-block">
                                                    {{ $message }}</div>
                                            </div>
                                        @enderror
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Action-->
                                    <div class="pb-lg-0 pb-5">
                                        <input type="submit"
                                            class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4"
                                            id="kt_login_signin_submit" value="Submit" />

                                    </div>
                                    <!--end::Action-->
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>


                    </div>
                    <!--end::Signin-->

                </div>
                <!--end::Content body-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
@endsection
@section('scripts')
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('js/pages/custom/login/login-general.js?v=7.0.5') }}"></script>
    <script>
        var interval;

        function countdown() {
            clearInterval(interval);
            interval = setInterval(function() {
                var timer = $('#timer').html();
                timer = timer.split(':');
                var minutes = timer[0];
                var seconds = timer[1];
                seconds -= 1;
                if (minutes < 0) return;
                else if (seconds < 0 && minutes != 0) {
                    minutes -= 1;
                    seconds = 59;
                } else if (seconds < 10 && length.seconds != 2) seconds = '0' + seconds;

                $('#timer').html(minutes + ':' + seconds);

                if (minutes == 0 && seconds == 0) {
                    clearInterval(interval);
                    $('#resend_text').hide();
                    $('#timer').hide();
                    $('#send-code').show();
                    $('#otp').attr('disabled', true);
                }
            }, 1000);

        }


        $(function() {
            $('#resend_text').hide();
            $('#timer').hide();
            $('#loader').hide();

        });

        $("#send-code").on("click", function(event) {
            event.preventDefault();
            $('#loader').show();
            $('#send-code').hide();
            // $("#save-category").attr("disabled", true);
            let _token = $('meta[name="csrf-token"]').attr("content");
            let phone = $('input[name="phone"]').val();

            // data = document.getElementById("add_customer_form"),
            $.ajax({
                url: "{{ route('add-phone.code') }}",
                type: "POST",
                data: {
                    _token: _token,
                    phone: phone,
                },
                complete: function() {
                    $('#loader').hide();
                },
                success: function(response) {
                    if (response == 404) {
                        $('#error-msg').html('Phone number is not registered on mgtos.');
                        $('#send-code').show();
                        $('#otp').attr('disabled', true);
                    } else if (response == "Error") {
                        toastr.error('Fail to send otp. Try again');
                        $('#send-code').show();
                        $('#otp').attr('disabled', true);
                    } else {
                        $('#error-msg').html('');
                        $('#otp').attr('disabled', false);
                        $('#resend_text').show();
                        $('#timer').show();
                        $('#timer').html('01:30');
                        countdown();
                    }
                },
                error: function(response) {
                    if (response != 404) {
                        // console.log(response.responseJSON.errors.phone[0]);
                        $('#error-msg').html(response.responseJSON.errors.phone[0]);
                        $('#send-code').show();
                    }
                }

            });
        });
    </script>
    <!--end::Page Scripts-->
@endsection
