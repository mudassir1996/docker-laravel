<div class="app">
    <div class="invoice">
        @include('pages.smart_invoice.templates.header.'.$header_template)
        <div class="invoice-container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-lg-offset-2">
                    @include('pages.smart_invoice.templates.body.'.$body_template)
                    @include('pages.smart_invoice.templates.footer.'.$footer_template)
                    
                </div>
                <div class="page-break ">
                    <p class="copyright text-center">
                        Solution by mgtos.com
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>