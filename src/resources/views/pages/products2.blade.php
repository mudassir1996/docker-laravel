@extends('layout.default')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Products</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">All Products</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <!--begin::Actions-->
                    <a href="#" class="btn btn-light font-weight-bold btn-sm">Actions</a>
                    <!--end::Actions-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                        <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="svg-icon svg-icon-success svg-icon-2x">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path
                                            d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z"
                                            fill="#000000" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                    <span class="font-size-lg">Choose Label:</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip"
                                        data-placement="right" title="Click to learn more..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-success">Customer</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-danger">Partner</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-primary">Member</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-dark">Staff</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-separator mt-3 opacity-70"></li>
                                <li class="navi-footer py-4">
                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                        <i class="ki ki-plus icon-sm"></i>Add new</a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Teachers-->
                <div class="d-flex flex-row">
                    <!--begin::Aside-->
                    <div class="flex-md-row-auto w-md-275px w-xl-325px">
                        <!--begin::List Widget 17-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">Popular Products</span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Sub heading goes here</span>
                                </h3>
                                <div class="card-toolbar">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions"
                                        data-placement="left">
                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover py-5">
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-drop"></i>
                                                        </span>
                                                        <span class="navi-text">New Group</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-list-3"></i>
                                                        </span>
                                                        <span class="navi-text">Contacts</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-rocket-1"></i>
                                                        </span>
                                                        <span class="navi-text">Groups</span>
                                                        <span class="navi-link-badge">
                                                            <span
                                                                class="label label-light-primary label-inline font-weight-bold">new</span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-bell-2"></i>
                                                        </span>
                                                        <span class="navi-text">Calls</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-gear"></i>
                                                        </span>
                                                        <span class="navi-text">Settings</span>
                                                    </a>
                                                </li>
                                                <li class="navi-separator my-3"></li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-magnifier-tool"></i>
                                                        </span>
                                                        <span class="navi-text">Help</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-bell-2"></i>
                                                        </span>
                                                        <span class="navi-text">Privacy</span>
                                                        <span class="navi-link-badge">
                                                            <span
                                                                class="label label-light-danger label-rounded font-weight-bold">5</span>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-4">
                                <!--begin::Container-->
                                <div>
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-8">
                                        <!--begin::Symbol-->
                                        <div class="symbol mr-5 pt-1">
                                            <div class="symbol-label min-w-65px min-h-100px"
                                                style="background-image: url({{ asset('media/img1.png') }})"></div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Title-->
                                            <a href="#"
                                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">HDMI
                                                Cable</a>
                                            <!--end::Title-->
                                            <!--begin::Text-->
                                            <span class="text-muted font-weight-bold font-size-sm pb-4">HDMI To Display
                                                Port
                                                <br />DP Cable Converter</span>
                                            <!--end::Text-->
                                            <!--begin::Action-->
                                            <div>
                                                <button type="button"
                                                    class="btn btn-light font-weight-bolder font-size-sm py-2">Book
                                                    Now</button>
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-8">
                                        <!--begin::Symbol-->
                                        <div class="symbol mr-5 pt-1">
                                            <div class="symbol-label min-w-65px min-h-100px"
                                                style="background-image: url({{ asset('media/img1.png') }})"></div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Title-->
                                            <a href="#"
                                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">HDMI
                                                Cable</a>
                                            <!--end::Title-->
                                            <!--begin::Text-->
                                            <span class="text-muted font-weight-bold font-size-sm pb-4">HDMI To Display
                                                Port
                                                <br />DP Cable Converter</span>
                                            <!--end::Text-->
                                            <!--begin::Action-->
                                            <div>
                                                <button type="button"
                                                    class="btn btn-light font-weight-bolder font-size-sm py-2">Book
                                                    Now</button>
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-8">
                                        <!--begin::Symbol-->
                                        <div class="symbol mr-5 pt-1">
                                            <div class="symbol-label min-w-65px min-h-100px"
                                                style="background-image: url({{ asset('media/img1.png') }})"></div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Title-->
                                            <a href="#"
                                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">HDMI
                                                Cable</a>
                                            <!--end::Title-->
                                            <!--begin::Text-->
                                            <span class="text-muted font-weight-bold font-size-sm pb-4">HDMI To Display
                                                Port
                                                <br />DP Cable Converter</span>
                                            <!--end::Text-->
                                            <!--begin::Action-->
                                            <div>
                                                <button type="button"
                                                    class="btn btn-light font-weight-bolder font-size-sm py-2">Book
                                                    Now</button>
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Container-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::List Widget 17-->
                        <!--begin::List Widget 8-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0">
                                <h3 class="card-title font-weight-bolder text-dark">Trends</h3>
                                <div class="card-toolbar">
                                    <div class="dropdown dropdown-inline">
                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-ver"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover">
                                                <li class="navi-header pb-1">
                                                    <span
                                                        class="text-primary text-uppercase font-weight-bold font-size-sm">Add
                                                        new:</span>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-shopping-cart-1"></i>
                                                        </span>
                                                        <span class="navi-text">Order</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-calendar-8"></i>
                                                        </span>
                                                        <span class="navi-text">Event</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-graph-1"></i>
                                                        </span>
                                                        <span class="navi-text">Report</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-rocket-1"></i>
                                                        </span>
                                                        <span class="navi-text">Post</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-writing"></i>
                                                        </span>
                                                        <span class="navi-text">File</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-0">
                                <!--begin::Item-->
                                <div class="mb-10">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light mr-5">
                                            <span class="symbol-label">
                                                <img src="assets/media/svg/misc/006-plurk.svg"
                                                    class="h-50 align-self-center" alt="" />
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a href="#"
                                                class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top
                                                Authors</a>
                                            <span class="text-muted font-weight-bold">5 day ago</span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Desc-->
                                    <p class="text-dark-50 m-0 pt-5 font-weight-normal">A brief write up about the top
                                        Authors that fits within this section</p>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="mb-10">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light mr-5">
                                            <span class="symbol-label">
                                                <img src="assets/media/svg/misc/015-telegram.svg"
                                                    class="h-50 align-self-center" alt="" />
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a href="#"
                                                class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Popular
                                                Authors</a>
                                            <span class="text-muted font-weight-bold">5 day ago</span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Desc-->
                                    <p class="text-dark-50 m-0 pt-5 font-weight-normal">A brief write up about the Popular
                                        Authors that fits within this section</p>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light mr-5">
                                            <span class="symbol-label">
                                                <img src="assets/media/svg/misc/014-kickstarter.svg"
                                                    class="h-50 align-self-center" alt="" />
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a href="#"
                                                class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">New
                                                Users</a>
                                            <span class="text-muted font-weight-bold">5 day ago</span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Desc-->
                                    <p class="text-dark-50 m-0 pt-5 font-weight-normal">A brief write up about the New
                                        Users that fits within this section</p>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end: Card-->
                        <!--end::List Widget 8-->
                    </div>
                    <!--end::Aside-->
                    <!--begin::Content-->
                    <div class="flex-row-fluid ml-lg-8">
                        <!--begin::Card-->
                        <div class="card card-custom">
                            <!--begin::Header-->
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">Products</span>
                                    <span class="text-muted mt-1 font-weight-bold font-size-sm">Manage products</span>
                                </h3>
                                <div class="card-toolbar">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title=""
                                        data-placement="left" data-original-title="Quick actions">
                                        <!--begin::Trigger Modal-->
                                        <a href="#" class="btn btn-success font-weight-bolder font-size-sm"
                                            aria-haspopup="true" aria-expanded="false" data-toggle="modal"
                                            data-target="#exampleModalCustomScrollable">New Student</a>
                                        <!--end::Trigger Modal-->
                                        <!--begin::Modal Content-->
                                        <div class="modal fade" id="exampleModalCustomScrollable" tabindex="-1"
                                            role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add New Student
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div data-scroll="true" data-height="600">
                                                            <form class="form pt-9">
                                                                <div class="form-group row">
                                                                    <label
                                                                        class="col-xl-3 col-lg-3 text-right col-form-label">Name</label>
                                                                    <div class="col-lg-9 col-xl-6">
                                                                        <input class="form-control   form-control-solid"
                                                                            type="text" value="Nick" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label
                                                                        class="col-xl-3 col-lg-3 text-right col-form-label">Nickname</label>
                                                                    <div class="col-lg-9 col-xl-6">
                                                                        <input class="form-control   form-control-solid"
                                                                            type="text" value="Bold" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label
                                                                        class="col-xl-3 col-lg-3 text-right col-form-label">Organization</label>
                                                                    <div class="col-lg-9 col-xl-6">
                                                                        <input class="form-control   form-control-solid"
                                                                            type="text" value="Loop Inc." />
                                                                        <span class="form-text text-muted">If you want your
                                                                            invoices addressed to a company. Leave blank to
                                                                            use your full name.</span>
                                                                    </div>
                                                                </div>
                                                                <div class="separator separator-dashed my-10"></div>
                                                                <!--begin::Heading-->
                                                                <div class="row">
                                                                    <div class="col-lg-9 col-xl-6 offset-xl-3">
                                                                        <h3 class="font-size-h6 mb-5">Contact Info:</h3>
                                                                    </div>
                                                                </div>
                                                                <!--end::Heading-->
                                                                <div class="form-group row">
                                                                    <label
                                                                        class="col-xl-3 col-lg-3 text-right col-form-label">Phone</label>
                                                                    <div class="col-lg-9 col-xl-6">
                                                                        <div
                                                                            class="input-group input-group-lg input-group-solid">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <i class="la la-phone"></i>
                                                                                </span>
                                                                            </div>
                                                                            <input type="text"
                                                                                class="form-control   form-control-solid"
                                                                                value="+35278953712" placeholder="Phone" />
                                                                        </div>
                                                                        <span class="form-text text-muted">We'll never
                                                                            share your email with anyone else.</span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label
                                                                        class="col-xl-3 col-lg-3 text-right col-form-label">Email
                                                                        Address</label>
                                                                    <div class="col-lg-9 col-xl-6">
                                                                        <div
                                                                            class="input-group input-group-lg input-group-solid">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <i class="la la-at"></i>
                                                                                </span>
                                                                            </div>
                                                                            <input type="text"
                                                                                class="form-control   form-control-solid"
                                                                                value="nick.bold@loop.com"
                                                                                placeholder="Email" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label
                                                                        class="col-xl-3 col-lg-3 text-right col-form-label">Site</label>
                                                                    <div class="col-lg-9 col-xl-6">
                                                                        <div
                                                                            class="input-group input-group-lg input-group-solid">
                                                                            <input type="text"
                                                                                class="form-control   form-control-solid"
                                                                                placeholder="Username" value="loop" />
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text">.com</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="separator separator-dashed my-10"></div>
                                                                <!--begin::Heading-->
                                                                <div class="row">
                                                                    <div class="col-lg-9 col-xl-6 offset-xl-3">
                                                                        <h3 class="font-size-h6 mb-5">Contact Info:</h3>
                                                                    </div>
                                                                </div>
                                                                <!--end::Heading-->
                                                                <div class="form-group row">
                                                                    <label
                                                                        class="col-xl-3 col-lg-3 text-right col-form-label">Email
                                                                        Notification</label>
                                                                    <div class="col-lg-9 col-xl-6">
                                                                        <span class="switch">
                                                                            <label>
                                                                                <input type="checkbox" checked="checked"
                                                                                    name="email_notification_1" />
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label
                                                                        class="col-xl-3 col-lg-3 text-right col-form-label">Send
                                                                        Copy</label>
                                                                    <div class="col-lg-9 col-xl-6">
                                                                        <span class="switch">
                                                                            <label>
                                                                                <input type="checkbox"
                                                                                    name="email_notification_2" />
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-light-primary font-weight-bold"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button type="button"
                                                            class="btn btn-primary font-weight-bold">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Modal Content-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin: Search Form-->
                                <!--begin::Search Form-->
                                <div class="mb-10">
                                    <div class="row align-items-center">
                                        <div class="col-lg-9 col-xl-8">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 my-2 my-md-0">
                                                    <div class="input-icon">
                                                        <input type="text" class="form-control form-control-solid"
                                                            placeholder="Search..." id="kt_datatable_search_query" />
                                                        <span>
                                                            <i class="flaticon2-search-1 text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 my-2 my-md-0">
                                                    <select class="form-control form-control-solid"
                                                        id="kt_datatable_search_status">
                                                        <option value="">Status</option>
                                                        <option value="1">Active</option>
                                                        <option value="2">Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 my-2 my-md-0">
                                                    <select class="form-control form-control-solid"
                                                        id="kt_datatable_search_allow_half">
                                                        <option value="">Allow Half</option>
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                                            <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Search Form-->
                                <!--end: Search Form-->
                                <!--begin: Datatable-->
                                <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
                                <!--end: Datatable-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Teachers-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection

{{-- Styles Section --}}
<!-- @section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection -->


{{-- Scripts Section --}}

@section('scripts')
    {{-- Products Data --}}
    <script src="{{ asset('js/products/products.js?v=7.0.5') }}"></script>
@endsection
