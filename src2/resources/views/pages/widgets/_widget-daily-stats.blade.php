<div class="col-xl-3 col-6">
    <!--begin::Stats Widget 29-->
    <div class="card card-custom bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url({{asset("media/svg/shapes/abstract-1.svg")}})">
        <!--begin::Body-->
        <div class="card-body">
            <span class="svg-icon svg-icon-3x svg-icon-info">
                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Cart1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <path d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z" fill="#000000" opacity="0.3" />
                        <path d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z" fill="#000000" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{count($new_products??'0')}}</span>
            <span class="font-weight-bold text-muted font-size-sm">New Products</span>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Stats Widget 29-->
</div>
<div class="col-xl-3 col-6">
    <!--begin::Stats Widget 30-->
    <div class="card card-custom bg-info card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body d-flex justify-content-between">
            <div class="d-flex flex-column flex-grow-1">
                <span class="svg-icon svg-icon-3x svg-icon-white">
                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Money.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) " />
                            <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>

                <span class="card-title font-weight-bolder text-white font-size-h2 mt-6 mb-0 d-none" id="profit">PKR {{$sales_orders->total_profit??'0.00'}}</span>
                <span class="card-title font-weight-bolder text-white font-size-h2 mt-6 mb-0 d-block" id="asterisk">PKR ****</span>
                <span class="font-weight-bold text-white font-size-sm">Total Profit</span>
            </div>
            <div class="align-self-end">
                <div class="col-12">
                    <span class="switch switch-sm switch-icon">
                        <label>
                            <input type="checkbox" id="profit_check" name="select" />
                            <span></span>
                        </label>
                    </span>
                </div>
            </div>


        </div>
        <!--end::Body-->
    </div>
    <!--end::Stats Widget 30-->
</div>
<div class="col-xl-3 col-6">
    <!--begin::Stats Widget 31-->
    <div class="card card-custom bg-danger card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <span class="svg-icon svg-icon-3x svg-icon-white">
                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-bar3.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <rect fill="#000000" opacity="0.3" x="7" y="4" width="3" height="13" rx="1.5" />
                        <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5" />
                        <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero" />
                        <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>

            <span class="card-title font-weight-bolder text-white font-size-h2 mt-6 mb-0 d-block" id="profit">PKR {{$expense??'0.00'}}</span>
            <span class="font-weight-bold text-white font-size-sm">Total Expenses</span>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Stats Widget 31-->
</div>
<div class="col-xl-3 col-6">
    <!--begin::Stats Widget 32-->
    <div class="card card-custom bg-primary card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <span class="svg-icon svg-icon-3x svg-icon-white">
                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Add-user.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
            <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$new_customers}}</span>
            <span class="font-weight-bold text-white font-size-sm">New Customers</span>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Stats Widget 32-->
</div>