{{-- Page Loader Types --}}

{{-- Default --}}
@if (config('layout.page-loader.type') == 'default')
<div class="page-loader">
    <div class="spinner spinner-primary"></div>
</div>
@endif

{{-- Spinner Message --}}
@if (config('layout.page-loader.type') == 'spinner-message')
<div class="page-loader page-loader-base">
    <div class="blockui">
        <span>Please wait...</span>
        <span>
            <div class="spinner spinner-primary"></div>
        </span>
    </div>
</div>
@endif

{{-- Spinner Logo --}}
@if (config('layout.page-loader.type') == 'spinner-logo')
<div class="page-loader page-loader-base">
    <div class="blockui">
        <span>
            <img width="50" alt="{{ config('app.name') }}" src="{{ asset('media/logos/animated.gif') }}" />
        </span>
        <span>
            <img alt="{{ config('app.name') }}" src="{{ asset('media/logos/MgtOs-loader2.png') }}" />
        </span>
    </div>
</div>
{{-- <div class="page-loader page-loader-logo">
    <img alt="{{ config('app.name') }}" src="{{ asset('media/logos/MgtOs-loader.png') }}" />
    <div class="spinner spinner-danger"></div>
</div> --}}
@endif