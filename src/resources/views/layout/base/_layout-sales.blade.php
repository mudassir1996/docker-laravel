@if(config('layout.self.layout') == 'blank')
<div class="d-flex flex-column flex-root">
    @yield('content')
</div>
@else

@include('layout.base._header-mobile')

<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
        @if(config('layout.aside.self.display'))
        @php
        config(['layout.aside.self.minimize.default' => true]);
        @endphp
        @include('layout.base._aside')
        @endif

         @include('layout.base._header')
        <div class="d-flex flex-column flex-row-fluid wrapper pt-10" id="kt_wrapper">
       

            @yield('content')
            

        </div>
    </div>
</div>

@endif

@if (config('layout.self.layout') != 'blank')

@if (config('layout.extras.search.layout') == 'offcanvas')
@include('layout.partials.extras.offcanvas._quick-search')
@endif

@if (config('layout.extras.notifications.layout') == 'offcanvas')
@include('layout.partials.extras.offcanvas._quick-notifications')
@endif

@if (config('layout.extras.quick-actions.layout') == 'offcanvas')
@include('layout.partials.extras.offcanvas._quick-actions')
@endif

@if (config('layout.extras.user.layout') == 'offcanvas')
@include('layout.partials.extras.offcanvas._quick-user')
@endif

@if (config('layout.extras.quick-panel.display'))
@include('layout.partials.extras.offcanvas._quick-panel')
@endif


@if (config('layout.extras.chat.display'))
@include('layout.partials.extras._chat')
@endif

@include('layout.partials.extras._scrolltop')

@endif