<!--begin::Heading-->
<div class="text-center">
    <!--begin::Title-->
    <h2 class="font-weight-bolder mb-2">Add your first product</h2>
    <!--end::Title-->
    <!--begin::Description-->
    <p class="text-dark-50 font-weight-bolder">Click on the below buttons to add product(s)
    </p>
    <!--end::Description-->
    <!--begin::Illustration-->
    <div class="text-center pb-5 px-5">
        <img src="{{ asset('media/bg/15.png') }}" alt="" class="mw-100 h-200px h-sm-325px">
    </div>
    <!--end::Illustration-->
    <!--begin::Action-->
    <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm px-8">Add
        Product</a>
    <a href="{{ route('standard-product') }}" class="btn btn-primary btn-sm px-8">Import From
        Catalogue</a>
    <a href="#" class="btn btn-primary btn-sm px-8" data-toggle="modal" data-target="#upload_model">Import CSV</a>
    <!--end::Action-->
</div>
<!--end::Heading-->
