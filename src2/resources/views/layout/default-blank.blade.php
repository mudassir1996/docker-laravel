<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}>

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6WW8MRQRLQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-6WW8MRQRLQ');
    </script>
    <meta charset="utf-8" />

  

    {{-- Title Section --}}
    <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon2.png') }}" />

    {{-- Fonts --}}
    {{ Metronic::getGoogleFontsInclude() }}

    {{-- Global Theme Styles (used by all pages) --}}
    @foreach(config('layout.resources.css') as $style)
    <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css" />
    @endforeach

    {{-- Layout Themes (used by all pages) --}}
    @foreach (Metronic::initThemes() as $theme)
    <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css" />
    @endforeach

    {{-- Includable CSS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    
    @yield('styles')
</head>

<body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>

    @if (config('layout.page-loader.type') != '')
    @include('layout.partials._page-loader')
    @endif

    @include('layout.base._layout-blank')



    <script>
        var HOST_URL = "{{ route('quick-search') }}";
    </script>


    {{-- Global Config (global config for global JS scripts) --}}
    <script>
        var KTAppSettings = {!!json_encode(config('layout.js'), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!};
    </script>

    {{-- Global Theme JS Bundle (used by all pages)  --}}
    @foreach(config('layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach

    {{--toastr js--}}
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
        @endif


        
    $("#password").on('click',function() {
        if ($(".password").attr('type') === 'password') {
            $(".password").attr('type', 'text');
        } else {
            $(".password").attr('type', 'password');
        }
        $(this).toggleClass("visible_inactive");
    });

    $("#password_confirm").on('click',function() {
        if ($(".password_confirm").attr('type') === 'password') {
            $(".password_confirm").attr('type', 'text');
        } else {
            $(".password_confirm").attr('type', 'password');
        }
        $(this).toggleClass("visible_inactive");
    });

    // $("#btn-submit").click(function() {
    //         if($('.has-danger')){
    //             $('html, body').animate({
    //             scrollTop: $(".card-header").offset().top
    //         }, 500);
    //         $('.alert-text').addClass('text-danger');
    //         }
    //     });

    </script>
    
    
    {{-- Includable JS --}}
    @yield('scripts')

</body>

</html>