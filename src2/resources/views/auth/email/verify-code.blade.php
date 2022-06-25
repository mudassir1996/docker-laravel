@extends('layout.default-blank')
@section('title', 'Verify Account')
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
                style="{{ auth()->guard('employee')->check()? 'background-color: #2b354e;': 'background-color: #D4192C;' }}">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                    <!--begin::Aside header-->
                    <p class="text-center display-2 font-weight-bold mb-10 text-light">
                        <!-- <img src="{{ asset('media/logos/logo-light.png') }}" class="max-h-70px" alt="" /> -->
                        MgtOS
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
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                    style="background-image: url({{ asset('media/svg/illustrations/login-visual-1.svg') }})"></div>
                <!--end::Aside Bottom-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div
                class="col-12 flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-center">
                    <div class="card w-75">
                        <div class="card-header py-3">
                            <div class="row align-items-center">
                                <div class="col-xl-6 ">
                                    {{ __('Phone Verification') }}
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
                            <form action="{{ route('verification.check') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control col-xl-8 form-control-solid h-auto py-5 px-6 rounded-lg font-size-h6"
                                        name="code" placeholder="Enter Verification Code Here">
                                    @error('code')
                                        <p class="text-danger font-size-sm">{{ $message }}</p>
                                    @enderror
                                    <a href="{{ route('verification.resend') }}" id="send_code"
                                        class="btn btn-link font-size-lg">Resend Code</a>
                                    <span class="btn text-primary font-size-lg" id="resend_text">Resend in <span
                                            id="timer">2:00</span></span>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4"
                                        value="Verify" />
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!--end::Content body-->
                <!--begin::Content footer-->
                <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                    <a href="#" class="text-primary font-weight-bolder font-size-h5">Terms</a>
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
        $('#send_code').hide();
        $('#resend_text').show();
        $('#timer').show();
        $('#timer').html('01:30');
        countdown();
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
                    $('#send_code').show();
                    // console.log("hello");
                    // $('#otp').attr('disabled', true);
                }
            }, 1000);

        }
    </script>
    <!--end::Page Scripts-->
@endsection
