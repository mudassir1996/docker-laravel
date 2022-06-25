@extends('layout.default')
@section('title', 'View Product')
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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Product</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="{{ route('products.index') }}" class="text-muted">All Products</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#" class="text-muted">View Products</a>
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
            <div class="container">
                <div class="d-flex row justify-content-center">
                    <div class="col-xl-10">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-tabs border-0 font-size-lg font-weight-bold" role="tablist">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link pb-4 active" data-bs-toggle="tab" href="#kt_product_details"
                                    data-toggle="pill">Product Details</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link pb-4" data-bs-toggle="tab" href="#kt_sales_history"
                                    data-toggle="pill">Sales
                                    History</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link pb-4" data-bs-toggle="tab" href="#kt_purchase_history"
                                    data-toggle="pill">Purchase History</a>
                            </li>
                            <!--end:::Tab item-->

                        </ul>
                        <!--end:::Tabs-->
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade active show" id="kt_product_details" role="tabpanel"
                                aria-labelledby="kt_product_details">
                                <div class="card card-custom card-stretch gutter-b">
                                    <div class="card-body p-15 pb-20">
                                        <div class="row mb-17">
                                            <div class="col-xxl-3 mb-11 mb-xxl-0">
                                                <!--begin::Image-->
                                                <img class="img-thumb-lg"
                                                    src="{{ Storage::disk('public')->exists('products/' . $product->product_feature_img) ? asset('storage/products/' . $product->product_feature_img) : asset('storage/' . $product->product_feature_img) }}">
                                                <!--end::Image-->
                                            </div>
                                            <div class="col-xxl-9 pl-xxl-11">
                                                <h2 class="font-weight-bolder text-dark mb-4" style="font-size: 32px;">
                                                    {{ $product->product_title }}</h2>
                                                <div class="font-size-h2 mb-4 text-dark-50">In Stock
                                                    <span class="text-info font-weight-boldest ml-2">
                                                        {{ $product->units_in_stock }}</span>
                                                </div>
                                                <div class="font-size-h2 mb-4 text-dark-50">Retail Price
                                                    <span class="text-info font-weight-boldest ml-2">PKR
                                                        {{ $product->retail_price }}</span>
                                                </div>
                                                <div class="line-height-xl">{{ $product->product_description }}</div>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <!--begin::Info-->
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Barcode</span>
                                                    <span
                                                        class="text-muted font-weight-bolder font-size-lg">{{ $product->product_barcode }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Stock keeping</span>
                                                    <span
                                                        class="text-muted font-weight-bolder font-size-lg">{{ $product->stock_keeping ? 'Yes' : 'No' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Allow Half</span>
                                                    <span
                                                        class="text-muted font-weight-bolder font-size-lg">{{ $product->product_allow_half ? 'Yes' : 'No' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Category</span>
                                                    <span class="text-muted font-weight-bolder font-size-lg">
                                                        @php
                                                            $category = \App\Models\Category::where('id', $product->category_id)->first();
                                                        @endphp
                                                        {{ $category->category_title }}

                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Company</span>
                                                    <span class="text-muted font-weight-bolder font-size-lg">
                                                        @php
                                                            $company = \App\Models\Company::where('id', $product->company_id)->first();
                                                        @endphp
                                                        {{ $company->company_title }}

                                                    </span>
                                                </div>
                                            </div>
                                            {{-- {{$product->product_metas}} --}}
                                            {{-- @foreach ($product->product_metas as $product_meta)
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">{{DB::table('custom_fields')->where('id', $product_meta->custom_field_id)->pluck('title')->first()}}</span>
                                                    <span class="text-muted font-weight-bolder font-size-lg">
                                                        {{$product_meta->value}}
                                                    </span>
                                                </div>
                                            </div>
                                         @endforeach --}}

                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Outlet</span>
                                                    <span class="text-muted font-weight-bolder font-size-lg">

                                                        {{ $product->outlet_title }}

                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Created By</span>
                                                    <span class="text-muted font-weight-bolder font-size-lg">
                                                        {{ $product->employee_name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Created At</span>
                                                    <span
                                                        class="text-muted font-weight-bolder font-size-lg">{{ date('d-m-Y h:i A', strtotime($product->created_at)) }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Updated At</span>
                                                    <span
                                                        class="text-muted font-weight-bolder font-size-lg">{{ date('d-m-Y h:i A', strtotime($product->updated_at)) }}</span>
                                                </div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--begin::Buttons-->
                                        <div class="d-flex">

                                            @if (!Auth::guard('web')->check())
                                                @can('product_edit')
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-primary btn-shadow font-weight-bolder mr-6 px-8 font-size-sm">
                                                        <span class="svg-icon">
                                                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Design/Edit.svg--><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24"
                                                                        height="24" />
                                                                    <path
                                                                        d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                                        fill="#000000" fill-rule="nonzero"
                                                                        transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                                                    <rect fill="#000000" opacity="0.3" x="5"
                                                                        y="20" width="15" height="2"
                                                                        rx="1" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>Edit</a>
                                                @endcan
                                            @else
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn btn-primary btn-shadow font-weight-bolder mr-6 px-8 font-size-sm">
                                                    <span class="svg-icon">
                                                        <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Design/Edit.svg--><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24" />
                                                                <path
                                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                                                <rect fill="#000000" opacity="0.3" x="5"
                                                                    y="20" width="15" height="2"
                                                                    rx="1" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>Edit</a>
                                            @endif

                                            <form action="{{ route('products.destroy', $product->id) }}"
                                                id="delete_item_from{{ $product->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                @if (!Auth::guard('web')->check())
                                                    @can('product_delete')
                                                        <a onclick="deleteConfirmation('delete_item_from{{ $product->id }}')"
                                                            class="btn btn-danger btn-shadow font-weight-bolder px-8 font-size-sm">
                                                            <span class="svg-icon">
                                                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none"
                                                                        fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24"
                                                                            height="24" />
                                                                        <path
                                                                            d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z"
                                                                            fill="#000000" fill-rule="nonzero" />
                                                                        <path
                                                                            d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                            fill="#000000" opacity="0.3" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>Delete</a>
                                                    @endcan
                                                @else
                                                    <a onclick="deleteConfirmation('delete_item_from{{ $product->id }}')"
                                                        class="btn btn-danger btn-shadow font-weight-bolder px-8 font-size-sm">
                                                        <span class="svg-icon">
                                                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24"
                                                                        height="24" />
                                                                    <path
                                                                        d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z"
                                                                        fill="#000000" fill-rule="nonzero" />
                                                                    <path
                                                                        d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                        fill="#000000" opacity="0.3" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>Delete</a>
                                                @endif
                                            </form>
                                        </div>
                                        <!--end::Buttons-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_sales_history" role="tabpanel"
                                aria-labelledby="kt_sales_history">
                                <div class="card card-custom card-stretch gutter-b">
                                    <div class="card-body p-15">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <h2 class="mb-5">Sales History</h2>

                                                <table class="table table-head-custom">
                                                    <thead>
                                                        <th>OrderID</th>
                                                        <th>Order Date</th>
                                                        <th>Quantity</th>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($sales_order_details as $sales_order_detail)
                                                            <tr>
                                                                <td>
                                                                    {{ $sales_order_detail->sales_order_id }}
                                                                </td>
                                                                <td>
                                                                    {{ $sales_order_detail->created_at }}
                                                                </td>
                                                                <td>
                                                                    {{ $sales_order_detail->quantity }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="3" class="text-center">No Orders Found
                                                                </td>

                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_purchase_history" role="tabpanel"
                                aria-labelledby="kt_purchase_history">
                                <div class="card card-custom card-stretch gutter-b">
                                    <div class="card-body p-15">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <h2 class="mb-5">Purchase History</h2>

                                                <table class="table table-head-custom">
                                                    <thead>
                                                        <th>OrderID</th>
                                                        <th>Purchase Date</th>
                                                        <th>Quantity</th>
                                                    </thead>
                                                    <tbody>

                                                        @forelse ($purchase_order_details as $purchase_order_detail)
                                                            <tr>
                                                                <td>
                                                                    {{ $purchase_order_detail->inventory_purchase_order_id }}
                                                                </td>
                                                                <td>
                                                                    {{ $purchase_order_detail->created_at }}
                                                                </td>
                                                                <td>
                                                                    {{ $purchase_order_detail->purchased_quantity }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="3" class="text-center">No Orders Found
                                                                </td>

                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Tab pane-->

                        </div>
                        <!--end::Tab content-->
                    </div>

                </div>
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
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5') }}"></script>

    {{-- Products Data --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/paginations.js?v=7.0.5') }}"></script>


@endsection
