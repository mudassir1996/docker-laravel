{{-- Extends layout --}}
@extends('layout.default')
@section('styles')
<style>
    .switch input:checked~span:after {
        background-color: #8950fc;
    }
</style>
@endsection
{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <!-- <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Add Purchase Order</a>
                    </li>
                </ul> -->
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
        <div class="d-flex align-items-center">
            <!--begin::Actions-->
            <div class="dropdown dropdown-inline">
                <a href="#" class="btn btn-light-primary font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="svg-icon">
                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Devices\Printer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000" />
                                <rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span> Print
                </a>
                <div class="dropdown-menu dropdown-menu-md py-5">
                    <ul class="navi navi-hover navi-link-rounded-lg">
                        <li class="navi-item">
                            <a class="navi-link" href="#" id="thermal">
                                <span class="navi-text">Thermal</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a class="navi-link" href="#" id="a4">
                                <span class="navi-text">A4</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!--end::Actions-->
        </div>

    </div>
</div>
<!--end::Subheader-->

<div class="row">
    @include('pages.widgets._widget-daily-stats')
    <div class="col-xl-6">
        @include('pages.widgets._widget-po-summary', ['class' => 'card-stretch gutter-b'])
    </div>
    <div class="col-xl-6">
        @include('pages.widgets._widget-sales-summary', ['class' => 'card-stretch gutter-b'])
    </div>



    <div class="col-lg-6 col-xxl-6">
        @include('pages.widgets._widget-1', ['class' => 'card-stretch gutter-b'])

    </div>
    <div class="col-lg-6 col-xxl-6">
        <!--begin::Mixed Widget 4-->
        <div class="card card-custom bg-radial-gradient-danger gutter-b card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title font-weight-bolder text-white">Weekly Sales Report</h3>

            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body d-flex flex-column p-0" style="position: relative;">
                <!--begin::Chart-->
                <div id="kt_mixed_widget_4_chart" style="height: 200px; min-height: 200px;">
                    <div id="apexcharts27zp6bzf" class="apexcharts-canvas apexcharts27zp6bzf apexcharts-theme-light" style="width: 413px; height: 200px;"><svg id="SvgjsSvg1419" width="413" height="200" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                            <g id="SvgjsG1421" class="apexcharts-inner apexcharts-graphical" transform="translate(20, 0)">
                                <defs id="SvgjsDefs1420">
                                    <linearGradient id="SvgjsLinearGradient1424" x1="0" y1="0" x2="0" y2="1">
                                        <stop id="SvgjsStop1425" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                        <stop id="SvgjsStop1426" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                        <stop id="SvgjsStop1427" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                    </linearGradient>
                                    <clipPath id="gridRectMask27zp6bzf">
                                        <rect id="SvgjsRect1429" width="378" height="201" x="-2.5" y="-0.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                    </clipPath>
                                    <clipPath id="gridRectMarkerMask27zp6bzf">
                                        <rect id="SvgjsRect1430" width="377" height="204" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                    </clipPath>
                                </defs>
                                <rect id="SvgjsRect1428" width="7.992857142857142" height="200" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1424)" class="apexcharts-xcrosshairs" y2="200" filter="none" fill-opacity="0.9"></rect>
                                <g id="SvgjsG1451" class="apexcharts-xaxis" transform="translate(0, 0)">
                                    <g id="SvgjsG1452" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g>
                                </g>
                                <g id="SvgjsG1454" class="apexcharts-grid">
                                    <g id="SvgjsG1455" class="apexcharts-gridlines-horizontal" style="display: none;">
                                        <line id="SvgjsLine1457" x1="0" y1="0" x2="373" y2="0" stroke="#ebedf3" stroke-dasharray="4" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1458" x1="0" y1="20" x2="373" y2="20" stroke="#ebedf3" stroke-dasharray="4" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1459" x1="0" y1="40" x2="373" y2="40" stroke="#ebedf3" stroke-dasharray="4" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1460" x1="0" y1="60" x2="373" y2="60" stroke="#ebedf3" stroke-dasharray="4" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1461" x1="0" y1="80" x2="373" y2="80" stroke="#ebedf3" stroke-dasharray="4" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1462" x1="0" y1="100" x2="373" y2="100" stroke="#ebedf3" stroke-dasharray="4" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1463" x1="0" y1="120" x2="373" y2="120" stroke="#ebedf3" stroke-dasharray="4" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1464" x1="0" y1="140" x2="373" y2="140" stroke="#ebedf3" stroke-dasharray="4" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1465" x1="0" y1="160" x2="373" y2="160" stroke="#ebedf3" stroke-dasharray="4" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1466" x1="0" y1="180" x2="373" y2="180" stroke="#ebedf3" stroke-dasharray="4" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1467" x1="0" y1="200" x2="373" y2="200" stroke="#ebedf3" stroke-dasharray="4" class="apexcharts-gridline"></line>
                                    </g>
                                    <g id="SvgjsG1456" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                                    <line id="SvgjsLine1469" x1="0" y1="200" x2="373" y2="200" stroke="transparent" stroke-dasharray="0"></line>
                                    <line id="SvgjsLine1468" x1="0" y1="1" x2="0" y2="200" stroke="transparent" stroke-dasharray="0"></line>
                                </g>
                                <g id="SvgjsG1432" class="apexcharts-bar-series apexcharts-plot-series">
                                    <g id="SvgjsG1433" class="apexcharts-series" rel="1" seriesName="NetxProfit" data:realIndex="0">
                                        <path id="SvgjsPath1435" d="M 18.65 200L 18.65 131.49821428571428Q 22.14642857142857 128.50178571428572 25.64285714285714 131.49821428571428L 25.64285714285714 131.49821428571428L 25.64285714285714 200L 25.64285714285714 200z" fill="rgba(255,255,255,0.25)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 18.65 200L 18.65 131.49821428571428Q 22.14642857142857 128.50178571428572 25.64285714285714 131.49821428571428L 25.64285714285714 131.49821428571428L 25.64285714285714 200L 25.64285714285714 200z" pathFrom="M 18.65 200L 18.65 200L 25.64285714285714 200L 25.64285714285714 200L 25.64285714285714 200L 18.65 200" cy="130" cx="71.43571428571428" j="0" val="35" barHeight="70" barWidth="7.992857142857142"></path>
                                        <path id="SvgjsPath1436" d="M 71.93571428571428 200L 71.93571428571428 71.49821428571428Q 75.43214285714285 68.50178571428572 78.92857142857143 71.49821428571428L 78.92857142857143 71.49821428571428L 78.92857142857143 200L 78.92857142857143 200z" fill="rgba(255,255,255,0.25)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 71.93571428571428 200L 71.93571428571428 71.49821428571428Q 75.43214285714285 68.50178571428572 78.92857142857143 71.49821428571428L 78.92857142857143 71.49821428571428L 78.92857142857143 200L 78.92857142857143 200z" pathFrom="M 71.93571428571428 200L 71.93571428571428 200L 78.92857142857143 200L 78.92857142857143 200L 78.92857142857143 200L 71.93571428571428 200" cy="70" cx="124.72142857142856" j="1" val="65" barHeight="130" barWidth="7.992857142857142"></path>
                                        <path id="SvgjsPath1437" d="M 125.22142857142856 200L 125.22142857142856 51.49821428571428Q 128.71785714285713 48.50178571428571 132.2142857142857 51.49821428571428L 132.2142857142857 51.49821428571428L 132.2142857142857 200L 132.2142857142857 200z" fill="rgba(255,255,255,0.25)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 125.22142857142856 200L 125.22142857142856 51.49821428571428Q 128.71785714285713 48.50178571428571 132.2142857142857 51.49821428571428L 132.2142857142857 51.49821428571428L 132.2142857142857 200L 132.2142857142857 200z" pathFrom="M 125.22142857142856 200L 125.22142857142856 200L 132.2142857142857 200L 132.2142857142857 200L 132.2142857142857 200L 125.22142857142856 200" cy="50" cx="178.00714285714284" j="2" val="75" barHeight="150" barWidth="7.992857142857142"></path>
                                        <path id="SvgjsPath1438" d="M 178.50714285714284 200L 178.50714285714284 91.49821428571428Q 182.0035714285714 88.50178571428572 185.49999999999997 91.49821428571428L 185.49999999999997 91.49821428571428L 185.49999999999997 200L 185.49999999999997 200z" fill="rgba(255,255,255,0.25)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 178.50714285714284 200L 178.50714285714284 91.49821428571428Q 182.0035714285714 88.50178571428572 185.49999999999997 91.49821428571428L 185.49999999999997 91.49821428571428L 185.49999999999997 200L 185.49999999999997 200z" pathFrom="M 178.50714285714284 200L 178.50714285714284 200L 185.49999999999997 200L 185.49999999999997 200L 185.49999999999997 200L 178.50714285714284 200" cy="90" cx="231.29285714285712" j="3" val="55" barHeight="110" barWidth="7.992857142857142"></path>
                                        <path id="SvgjsPath1439" d="M 231.79285714285712 200L 231.79285714285712 111.49821428571428Q 235.28928571428568 108.50178571428572 238.78571428571425 111.49821428571428L 238.78571428571425 111.49821428571428L 238.78571428571425 200L 238.78571428571425 200z" fill="rgba(255,255,255,0.25)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 231.79285714285712 200L 231.79285714285712 111.49821428571428Q 235.28928571428568 108.50178571428572 238.78571428571425 111.49821428571428L 238.78571428571425 111.49821428571428L 238.78571428571425 200L 238.78571428571425 200z" pathFrom="M 231.79285714285712 200L 231.79285714285712 200L 238.78571428571425 200L 238.78571428571425 200L 238.78571428571425 200L 231.79285714285712 200" cy="110" cx="284.5785714285714" j="4" val="45" barHeight="90" barWidth="7.992857142857142"></path>
                                        <path id="SvgjsPath1440" d="M 285.0785714285714 200L 285.0785714285714 81.49821428571428Q 288.575 78.50178571428572 292.07142857142856 81.49821428571428L 292.07142857142856 81.49821428571428L 292.07142857142856 200L 292.07142857142856 200z" fill="rgba(255,255,255,0.25)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 285.0785714285714 200L 285.0785714285714 81.49821428571428Q 288.575 78.50178571428572 292.07142857142856 81.49821428571428L 292.07142857142856 81.49821428571428L 292.07142857142856 200L 292.07142857142856 200z" pathFrom="M 285.0785714285714 200L 285.0785714285714 200L 292.07142857142856 200L 292.07142857142856 200L 292.07142857142856 200L 285.0785714285714 200" cy="80" cx="337.8642857142857" j="5" val="60" barHeight="120" barWidth="7.992857142857142"></path>
                                        <path id="SvgjsPath1441" d="M 338.3642857142857 200L 338.3642857142857 91.49821428571428Q 341.86071428571427 88.50178571428572 345.35714285714283 91.49821428571428L 345.35714285714283 91.49821428571428L 345.35714285714283 200L 345.35714285714283 200z" fill="rgba(255,255,255,0.25)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 338.3642857142857 200L 338.3642857142857 91.49821428571428Q 341.86071428571427 88.50178571428572 345.35714285714283 91.49821428571428L 345.35714285714283 91.49821428571428L 345.35714285714283 200L 345.35714285714283 200z" pathFrom="M 338.3642857142857 200L 338.3642857142857 200L 345.35714285714283 200L 345.35714285714283 200L 345.35714285714283 200L 338.3642857142857 200" cy="90" cx="391.15" j="6" val="55" barHeight="110" barWidth="7.992857142857142"></path>
                                    </g>
                                    <g id="SvgjsG1442" class="apexcharts-series" rel="2" seriesName="Revenue" data:realIndex="1">
                                        <path id="SvgjsPath1444" d="M 26.64285714285714 200L 26.64285714285714 121.49821428571428Q 30.13928571428571 118.50178571428572 33.63571428571428 121.49821428571428L 33.63571428571428 121.49821428571428L 33.63571428571428 200L 33.63571428571428 200z" fill="rgba(255,255,255,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 26.64285714285714 200L 26.64285714285714 121.49821428571428Q 30.13928571428571 118.50178571428572 33.63571428571428 121.49821428571428L 33.63571428571428 121.49821428571428L 33.63571428571428 200L 33.63571428571428 200z" pathFrom="M 26.64285714285714 200L 26.64285714285714 200L 33.63571428571428 200L 33.63571428571428 200L 33.63571428571428 200L 26.64285714285714 200" cy="120" cx="79.42857142857143" j="0" val="40" barHeight="80" barWidth="7.992857142857142"></path>
                                        <path id="SvgjsPath1445" d="M 79.92857142857143 200L 79.92857142857143 61.49821428571428Q 83.425 58.50178571428571 86.92142857142858 61.49821428571428L 86.92142857142858 61.49821428571428L 86.92142857142858 200L 86.92142857142858 200z" fill="rgba(255,255,255,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 79.92857142857143 200L 79.92857142857143 61.49821428571428Q 83.425 58.50178571428571 86.92142857142858 61.49821428571428L 86.92142857142858 61.49821428571428L 86.92142857142858 200L 86.92142857142858 200z" pathFrom="M 79.92857142857143 200L 79.92857142857143 200L 86.92142857142858 200L 86.92142857142858 200L 86.92142857142858 200L 79.92857142857143 200" cy="60" cx="132.7142857142857" j="1" val="70" barHeight="140" barWidth="7.992857142857142"></path>
                                        <path id="SvgjsPath1446" d="M 133.2142857142857 200L 133.2142857142857 41.49821428571428Q 136.71071428571426 38.50178571428571 140.20714285714283 41.49821428571428L 140.20714285714283 41.49821428571428L 140.20714285714283 200L 140.20714285714283 200z" fill="rgba(255,255,255,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 133.2142857142857 200L 133.2142857142857 41.49821428571428Q 136.71071428571426 38.50178571428571 140.20714285714283 41.49821428571428L 140.20714285714283 41.49821428571428L 140.20714285714283 200L 140.20714285714283 200z" pathFrom="M 133.2142857142857 200L 133.2142857142857 200L 140.20714285714283 200L 140.20714285714283 200L 140.20714285714283 200L 133.2142857142857 200" cy="40" cx="185.99999999999997" j="2" val="80" barHeight="160" barWidth="7.992857142857142"></path>
                                        <path id="SvgjsPath1447" d="M 186.49999999999997 200L 186.49999999999997 81.49821428571428Q 189.99642857142854 78.50178571428572 193.4928571428571 81.49821428571428L 193.4928571428571 81.49821428571428L 193.4928571428571 200L 193.4928571428571 200z" fill="rgba(255,255,255,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 186.49999999999997 200L 186.49999999999997 81.49821428571428Q 189.99642857142854 78.50178571428572 193.4928571428571 81.49821428571428L 193.4928571428571 81.49821428571428L 193.4928571428571 200L 193.4928571428571 200z" pathFrom="M 186.49999999999997 200L 186.49999999999997 200L 193.4928571428571 200L 193.4928571428571 200L 193.4928571428571 200L 186.49999999999997 200" cy="80" cx="239.28571428571425" j="3" val="60" barHeight="120" barWidth="7.992857142857142"></path>
                                        <path id="SvgjsPath1448" d="M 239.78571428571425 200L 239.78571428571425 101.49821428571428Q 243.28214285714282 98.50178571428572 246.77857142857138 101.49821428571428L 246.77857142857138 101.49821428571428L 246.77857142857138 200L 246.77857142857138 200z" fill="rgba(255,255,255,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 239.78571428571425 200L 239.78571428571425 101.49821428571428Q 243.28214285714282 98.50178571428572 246.77857142857138 101.49821428571428L 246.77857142857138 101.49821428571428L 246.77857142857138 200L 246.77857142857138 200z" pathFrom="M 239.78571428571425 200L 239.78571428571425 200L 246.77857142857138 200L 246.77857142857138 200L 246.77857142857138 200L 239.78571428571425 200" cy="100" cx="292.57142857142856" j="4" val="50" barHeight="100" barWidth="7.992857142857142"></path>
                                        <path id="SvgjsPath1449" d="M 293.07142857142856 200L 293.07142857142856 71.49821428571428Q 296.5678571428571 68.50178571428572 300.0642857142857 71.49821428571428L 300.0642857142857 71.49821428571428L 300.0642857142857 200L 300.0642857142857 200z" fill="rgba(255,255,255,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 293.07142857142856 200L 293.07142857142856 71.49821428571428Q 296.5678571428571 68.50178571428572 300.0642857142857 71.49821428571428L 300.0642857142857 71.49821428571428L 300.0642857142857 200L 300.0642857142857 200z" pathFrom="M 293.07142857142856 200L 293.07142857142856 200L 300.0642857142857 200L 300.0642857142857 200L 300.0642857142857 200L 293.07142857142856 200" cy="70" cx="345.85714285714283" j="5" val="65" barHeight="130" barWidth="7.992857142857142"></path>
                                        <path id="SvgjsPath1450" d="M 346.35714285714283 200L 346.35714285714283 81.49821428571428Q 349.8535714285714 78.50178571428572 353.34999999999997 81.49821428571428L 353.34999999999997 81.49821428571428L 353.34999999999997 200L 353.34999999999997 200z" fill="rgba(255,255,255,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="square" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask27zp6bzf)" pathTo="M 346.35714285714283 200L 346.35714285714283 81.49821428571428Q 349.8535714285714 78.50178571428572 353.34999999999997 81.49821428571428L 353.34999999999997 81.49821428571428L 353.34999999999997 200L 353.34999999999997 200z" pathFrom="M 346.35714285714283 200L 346.35714285714283 200L 353.34999999999997 200L 353.34999999999997 200L 353.34999999999997 200L 346.35714285714283 200" cy="80" cx="399.1428571428571" j="6" val="60" barHeight="120" barWidth="7.992857142857142"></path>
                                        <g id="SvgjsG1443" class="apexcharts-datalabels" data:realIndex="1"></g>
                                    </g>
                                    <g id="SvgjsG1434" class="apexcharts-datalabels" data:realIndex="0"></g>
                                </g>
                                <line id="SvgjsLine1470" x1="0" y1="0" x2="373" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                <line id="SvgjsLine1471" x1="0" y1="0" x2="373" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                <g id="SvgjsG1472" class="apexcharts-yaxis-annotations"></g>
                                <g id="SvgjsG1473" class="apexcharts-xaxis-annotations"></g>
                                <g id="SvgjsG1474" class="apexcharts-point-annotations"></g>
                            </g>
                            <g id="SvgjsG1453" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                            <g id="SvgjsG1422" class="apexcharts-annotations"></g>
                        </svg>
                        <div class="apexcharts-legend"></div>
                        <div class="apexcharts-tooltip apexcharts-theme-light">
                            <div class="apexcharts-tooltip-title" style="font-family: Poppins; font-size: 12px;"></div>
                            <div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 255, 255);"></span>
                                <div class="apexcharts-tooltip-text" style="font-family: Poppins; font-size: 12px;">
                                    <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div>
                                    <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                </div>
                            </div>
                            <div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 255, 255);"></span>
                                <div class="apexcharts-tooltip-text" style="font-family: Poppins; font-size: 12px;">
                                    <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div>
                                    <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                            <div class="apexcharts-yaxistooltip-text"></div>
                        </div>
                    </div>
                </div>
                <!--end::Chart-->
                <!--begin::Stats-->
                <div class="card-spacer bg-white card-rounded flex-grow-1">
                    <!--begin::Row-->
                    <div class="row m-0">
                        <div class="col px-8 py-6 mr-8">
                            <div class="font-size-sm text-muted font-weight-bold">No. of Sales</div>
                            <div class="font-size-h4 font-weight-bolder">{{$no_of_sales}}</div>
                        </div>
                        <div class="col px-8 py-6">
                            <div class="font-size-sm text-muted font-weight-bold">Weekly Sales</div>
                            <div class="font-size-h4 font-weight-bolder">PKR {{$sales}}</div>
                        </div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row m-0">
                        <div class="col px-8 py-6 mr-8">
                            <div class="font-size-sm text-muted font-weight-bold">Weekly Profit</div>
                            <div class="font-size-h4 font-weight-bolder">PKR {{$profit}}</div>
                        </div>
                        <div class="col px-8 py-6">
                            <div class="font-size-sm text-muted font-weight-bold">Weekly Discount</div>
                            <div class="font-size-h4 font-weight-bolder">PKR {{$discount}}</div>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Stats-->
                <div class="resize-triggers">
                    <div class="expand-trigger">
                        <div style="width: 414px; height: 448px;"></div>
                    </div>
                    <div class="contract-trigger"></div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 4-->
    </div>
</div>
@endsection

@section('scripts')
<script>
    var url = "{{route('outlets.summary')}}";
    var profit = 0;
    $('#profit_check').click(function() {
        if ($(this).is(":checked")) {
            profit = 1;
            $('#profit').toggleClass('d-none');
            $('#profit').toggleClass('d-block');
            $('#asterisk').toggleClass('d-none');
            $('#asterisk').toggleClass('d-block');
        } else {
            profit = 0
            $('#profit').toggleClass('d-none');
            $('#profit').toggleClass('d-block');
            $('#asterisk').toggleClass('d-none');
            $('#asterisk').toggleClass('d-block');
        }
    });

    $('#thermal').click(function() {
        window.open(url + '?show_id=' + profit + '&page=thermal', '_blank', 'width=400');
    });
    $('#a4').click(function() {
        window.open(url + '?show_id=' + profit + '&page=a4', '_blank', 'width=1000');
    });
</script>
@endsection