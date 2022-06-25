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
    <div class="container-fluid px-5 py-0 h-100">
        <div class="row justify-content-center h-100">
            <div class="col-lg-12 px-0">
                <!--begin::Card-->
                <div class="card card-custom bg-light h-100">
                    <div class="card-body px-0">
                        <div class="row justify-content-center h-100 mx-0 align-items-center">
                            <div class="col-xl-6 col-12">
                                <div class="row my-5 py-5">
                                    <div class="col-12 ">
                                        <h1 class="display-2 text-center">Outlets</h1>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    @php
                                    $count=0;
                                    @endphp
                                    @foreach($outlets as $outlet)
                                    @if (Auth::guard('web')->check())
                                    <div class="col-xl-3 col-6">
                                        <!--begin::Tiles Widget 11-->
                                        <div class="card card-custom {{$bg_class[$count]}}  gutter-b" style="height: 150px">
                                            <a href="outlets/get-session?outlet_id={{$outlet->id}}&outlet_title={{$outlet->outlet_title}}">
                                                <div class="card-body">
                                                    <span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
                                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Cart1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z" fill="#000000" opacity="0.3" />
                                                                <path d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z" fill="#000000" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                    <div class="text-inverse-success font-weight-bolder font-size-h4 mt-3">{{substr($outlet->outlet_title,0,20)}}</div>
                                                    <p class="text-inverse-success font-weight-bold font-size-sm mt-1">{{substr($outlet->outlet_address,0,22)}}...</p>
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Tiles Widget 11-->
                                    </div>
                                    @elseif (Auth::guard('employee')->check())
                                    
                                    @foreach($outlet->outlet as $key => $item)
                                    <div class="col-xl-3 col-6">
                                        <!--begin::Tiles Widget 11-->
                                        <div class="card card-custom {{$bg_class[$count]}}  gutter-b" style="height: 150px">
                                            <a href="outlets/get-session?outlet_id={{$item->id}}&outlet_title={{$item->outlet_title}}">
                                                <div class="card-body">
                                                    <span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
                                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Cart1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z" fill="#000000" opacity="0.3" />
                                                                <path d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z" fill="#000000" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                    <div class="text-inverse-success font-weight-bolder font-size-h4 mt-3">{{substr($item->outlet_title,0,20)}}</div>
                                                    <p class="text-inverse-success font-weight-bold font-size-sm mt-1">{{substr($item->outlet_address,0,22)}}...</p>
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Tiles Widget 11-->
                                    </div>
                                    @endforeach
                                    @endif


                                    @php
                                    $count++;
                                    if($count==5){
                                    $count=0;
                                    }
                                    @endphp


                                    @endforeach

                                    @if(!Auth::guard('web')->check())
                                    @can('outlet_create')
                                    <div class="col-xl-3 col-6">
                                        <!--begin::Tiles Widget 11-->
                                        <a href="{{route('outlets.create')}}">
                                            <div class="card card-custom bg-hover-state-light gutter-b" style="height:150px;">
                                                <div class="row justify-content-center h-100 align-items-center">
                                                    <span class="svg-icon svg-icon-6x svg-icon-success">
                                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                                <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                        <!--end::Tiles Widget 11-->
                                    </div>

                                    @endcan
                                    @else
                                    <div class="col-xl-3 col-6">
                                        <!--begin::Tiles Widget 11-->
                                        <a href="{{route('outlets.create')}}">
                                            <div class="card card-custom bg-hover-state-light gutter-b" style="height:150px;">
                                                <div class="row justify-content-center h-100 align-items-center">
                                                    <span class="svg-icon svg-icon-6x svg-icon-success">
                                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                                <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                        <!--end::Tiles Widget 11-->
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>
    <!--end::Entry-->
</div>
@endsection

{{-- Styles Section --}}
<!-- @section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection -->


{{-- Scripts Section --}}