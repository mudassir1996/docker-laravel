@extends('layout.default-blank')
@section('title', 'Coming Soon')
@section('content')
<div class="d-flex flex-column flex-root">
    <!--begin::Error-->
    <div class="error error-6 d-flex pt-40 flex-row-fluid " style="background-color: #D4192C;">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-row-fluid text-center">
            <div class="col-12">
                <h1 class="error-title display-1 font-weight-boldest text-white mb-12" style="margin-top: 12rem;">Coming Soon</h1>
                <p class="display-4 font-weight-bold text-white">We are currently working on this page. </p>
                <a href="{{route('purchase-orders.index')}}" class="btn btn-light font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Arrow-left.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-12.000000, -12.000000) " x="11" y="5" width="2" height="14" rx="1" />
                                <path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) " />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Go Back</a>
            </div>


        </div>

        <!--end::Content-->
    </div>
    <!--end::Error-->
</div>
@endsection