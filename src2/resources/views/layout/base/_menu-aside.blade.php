<div id="kt_aside_menu" class="aside-menu pb-20 my-4 scroll ps ps--active-y" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="height: 306px; overflow: hidden;">
    <ul class="menu-nav ">
        @php
            $premium = App\Classes\Subscriber::isPremium();
        @endphp
        
        @if(!Auth::guard('web')->check())
        @include('layout.base.emp_aside')
        @else
        @include('layout.base.user_aside')
        @endif
    </ul>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; height: 306px; right: 4px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 182px;"></div>
    </div>
</div>