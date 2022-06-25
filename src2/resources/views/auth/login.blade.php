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
            <div class="login-aside d-flex flex-column flex-row-auto"
                style="{{ request()->is('employee/login') ? 'background-color: #2b354e;' : 'background-color: #E30423;' }}">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                    <!--begin::Aside header-->
                    <p class="text-center display-2 font-weight-bold mb-10 text-light" style="font-family: logo-font;">
                        {{-- <img src="{{asset('media/logos/logo-light.png')}}" class="max-h-70px" alt="" /> --}}
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
                            @if (request()->is('employee/login'))
                                <span class="text-muted font-weight-bold font-size-h4">Employee Login</span>
                            @else
                                <span class="text-muted font-weight-bold font-size-h4">New Here?
                                    <a href="{{ route('register') }}" id="kt_login_signup"
                                        class="text-primary font-weight-bolder">Create an Account</a>
                                </span>
                            @endif
                        </div>
                        <!--begin::Title-->
                        <div class="card card-custom">
                            <div class="card-header">
                                {{-- <div class="card-title">
                                <h3 class="card-label">Login With Email</h3>
                            </div> --}}
                                <div class="card-toolbar">
                                    <ul class="nav nav-bold nav-pills" id="myTab">
                                        <li class="nav-item">
                                            <a class="nav-link active " data-toggle="tab" href="#kt_tab_pane_7_1">Login With
                                                Password</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab" href="#kt_tab_pane_7_2">Login With
                                                Otp</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="kt_tab_pane_7_1" role="tabpanel"
                                        aria-labelledby="kt_tab_pane_7_1">
                                        <!--begin::Form-->
                                        <form class="form" method="POST"
                                            action="{{ request()->is('employee/login') ? route('employee.login') : route('login') }}"
                                            novalidate="novalidate" id="kt_login_signin_form">
                                            @csrf

                                            @error('status')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <label
                                                    class="font-size-h6 font-weight-bolder text-dark">{{ request()->is('employee/login') ? 'Email' : 'Email/Phone' }}</label>
                                                <input
                                                    class="form-control form-control-solid font-size-h6 h-auto py-5 px-6 rounded-lg @error('email') is-invalid @enderror"
                                                    autofocus type="text" name="email" value="{{ old('email') }}"
                                                    autocomplete="off"
                                                    placeholder="{{ request()->is('employee/login') ? 'Email' : 'Email/Phone' }}" />
                                                @error('email')
                                                    <div class="fv-plugins-message-container">
                                                        <div data-field="email" data-validator="notEmpty"
                                                            class="fv-help-block">{{ $message }}</div>
                                                    </div>
                                                @enderror
                                            </div>

                                            <!--end::Form group-->
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between mt-n5">
                                                    <label
                                                        class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                                                    <a href="{{ route('password.request') }}"
                                                        class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">Forgot
                                                        Password ?</a>
                                                </div>


                                                <input
                                                    class="form-control form-control-solid font-size-h6 h-auto py-5 px-6 rounded-lg password @error('password') is-invalid @enderror"
                                                    type="password" name="password" autocomplete="off"
                                                    placeholder="Password" />
                                                <span class="visible_active" id="password"></span>
                                                @error('password')
                                                    <div class="fv-plugins-message-container">
                                                        <div data-field="password" data-validator="notEmpty"
                                                            class="fv-help-block">{{ $message }}</div>
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
                                    <div class="tab-pane fade" id="kt_tab_pane_7_2" role="tabpanel"
                                        aria-labelledby="kt_tab_pane_7_2">
                                        <!--begin::Form-->
                                        <form class="form" method="POST"
                                            action="{{ request()->is('employee/login') ? route('employee.phone.login') : route('phone.login') }}"
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
                                                        <div data-field="phone" data-validator="notEmpty"
                                                            class="fv-help-block">{{ $message }}</div>
                                                    </div>
                                                @enderror
                                            </div>
                                            <!--end::Form group-->
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between mt-n5">
                                                    <label
                                                        class="font-size-h6 font-weight-bolder text-dark pt-5">OTP</label>
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
                                                    class="form-control form-control-solid font-size-h6 h-auto py-5 px-6 rounded-lg @error('otp') is-invalid @enderror"
                                                    type="text" name="otp" id="otp" autocomplete="off"
                                                    placeholder="Enter OTP Here" />
                                                @error('otp')
                                                    <div class="fv-plugins-message-container">
                                                        <div data-field="otp" data-validator="notEmpty" class="fv-help-block">
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
                        </div>


                    </div>
                    <!--end::Signin-->

                </div>
                <!--end::Content body-->
                <!--begin::Content footer-->
                <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                    @if (request()->is('employee/login'))
                        <a href="{{ route('login') }}" class="text-primary font-weight-bolder font-size-h5">Login</a>
                    @else
                        <a href="{{ route('employee.login') }}"
                            class="text-primary font-weight-bolder font-size-h5">Employee Login</a>
                    @endif
                    <a href="#" class="text-primary ml-10 font-weight-bolder font-size-h5">Terms</a>
                    <a href="#" class="text-primary ml-10 font-weight-bolder font-size-h5">Plans</a>
                    <a href="#" class="text-primary ml-10 font-weight-bolder font-size-h5">Contact Us</a>
                </div>
                <!--end::Content footer-->
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
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
        });

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
                    // $('#otp').attr('disabled', true);
                }
            }, 1000);

        }


        $(function() {
            $('#resend_text').hide();
            $('#timer').hide();
            $('#loader').hide();
            $('#otp').attr('disabled', true);
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
                url: "{{ route('otp.send') }}",
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
