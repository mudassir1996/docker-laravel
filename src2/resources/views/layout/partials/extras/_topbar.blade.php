{{-- Topbar --}}
<div class="topbar">


    @if (session('outlet_id'))
        <div class="topbar-item">
            @can('sales_screen')
                @if (!Auth::guard('web')->check())
                    @can('sales_create')
                        <a href="{{ route('sales.index') }}" class="btn btn-dark align-middle font-weight-bold mr-2">
                            <i class="fas fa-shopping-bag icon-sm"></i> POS
                        </a>
                    @endcan
                @else
                    <a href="{{ route('sales.index') }}" class="btn btn-dark align-middle font-weight-bold mr-2">
                        <i class="fas fa-shopping-bag icon-sm"></i> POS
                    </a>
                @endif
            @endcan
            @can('airline_sales_screen')
                @if (!Auth::guard('web')->check())
                    @can('sales_create')
                        <a href="{{ route('airline-orders.create') }}" class="btn btn-dark align-middle font-weight-bold mr-2">
                            <i class="fas fa-shopping-bag icon-sm"></i> POS
                        </a>
                    @endcan
                @else
                    <a href="{{ route('airline-orders.create') }}" class="btn btn-dark align-middle font-weight-bold mr-2">
                        <i class="fas fa-shopping-bag icon-sm"></i> POS
                    </a>
                @endif
            @endcan
        </div>
    @endif
    {{-- <div class="topbar-item">
        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">Outlet Name</span>
    </div> --}}
    <div class="topbar-item">
        <a id="btnFullscreen" class="btn" data-toggle="tooltip" title="Full Screen">
            <i class="fas fa-expand-arrows-alt text-primary"></i>
        </a>
    </div>
    {{-- Search --}}
    @if (config('layout.extras.search.display'))
        @if (config('layout.extras.search.layout') == 'offcanvas')
            <div class="topbar-item">
                <div class="btn btn-icon btn-clean btn-lg mr-1" id="kt_quick_search_toggle">
                    {{ Metronic::getSVG('media/svg/icons/General/Search.svg', 'svg-icon-xl svg-icon-primary') }}
                </div>
            </div>
        @else
            <div class="dropdown" id="kt_quick_search_toggle">
                {{-- Toggle --}}
                <!-- <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
            <div class="btn btn-icon btn-clean btn-lg btn-dropdown mr-1">
                {{-- Metronic::getSVG("media/svg/icons/General/Search.svg", "svg-icon-xl svg-icon-primary") --}}
            </div>
        </div> -->

                {{-- Dropdown --}}
                <!-- <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
            {{-- @include('layout.partials.extras.dropdown._search-dropdown') --}}
        </div> -->
            </div>
        @endif
    @endif

    {{-- Notifications --}}
    @if (config('layout.extras.notifications.display'))
        @if (config('layout.extras.notifications.layout') == 'offcanvas')
            <!-- -=<div class="topbar-item">
        <div class="btn btn-icon btn-clean btn-lg mr-1 pulse pulse-primary" id="kt_quick_notifications_toggle">
            <div class="symbol symbol-circle symbol-50">
                <i class="fas fa-bell fa-xl text-primary"></i>
                <i class="symbol-badge bg-warning"></i>
            </div>
            <span class="pulse-ring"></span>
        </div>
    </div> -->
        @else
            <div class="dropdown">
                @php
                    $notifications = DB::table('notification_outlet')
                        ->join('notifications', 'notification_outlet.notification_id', 'notifications.id')
                        ->where('notification_outlet.outlet_id', session('outlet_id'))
                        ->orderBy('notification_outlet.id', 'desc')
                        ->get();
                    $data = [];
                    $have_unread = 0;
                @endphp
                @if ($notifications->where('read_at', null)->count('id') > 0)
                    @php
                        $have_unread = 1;
                    @endphp
                @endif
                {{-- Toggle --}}
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div
                        class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 {{ $have_unread ? 'pulse pulse-primary' : '' }} ">
                        <div class="symbol symbol-circle symbol-50">
                            <i class="fas fa-bell fa-xl text-primary"></i>
                            @if ($have_unread)
                                <i class="symbol-badge bg-warning"></i>
                            @endif
                        </div>
                        <span class="pulse-ring"></span>
                    </div>
                </div>

                {{-- Dropdown --}}
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    <form>
                        @include('layout.partials.extras.dropdown._notifications')
                    </form>
                </div>
            </div>
        @endif
    @endif

    {{-- Quick Actions --}}
    @if (config('layout.extras.quick-actions.display'))
        @if (config('layout.extras.quick-actions.layout') == 'offcanvas')
            <div class="topbar-item">
                <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1" id="kt_quick_actions_toggle">
                    {{ Metronic::getSVG('media/svg/icons/Media/Equalizer.svg', 'svg-icon-xl svg-icon-primary') }}
                </div>
            </div>
        @else
            <div class="dropdown">
                {{-- Toggle --}}
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                        {{ Metronic::getSVG('media/svg/icons/Media/Equalizer.svg', 'svg-icon-xl svg-icon-primary') }}
                    </div>
                </div>

                {{-- Dropdown --}}
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    @include('layout.partials.extras.dropdown._quick-actions')
                </div>
            </div>
        @endif
    @endif

    {{-- My Cart --}}
    @if (config('layout.extras.cart.display'))
        <div class="dropdown">
            {{-- Toggle --}}
            <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                    {{ Metronic::getSVG('media/svg/icons/Shopping/Cart3.svg', 'svg-icon-xl svg-icon-primary') }}
                </div>
            </div>

            {{-- Dropdown --}}
            <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-xl dropdown-menu-anim-up">
                <form>
                    @include('layout.partials.extras.dropdown._cart')
                </form>
            </div>
        </div>
    @endif

    {{-- Quick panel --}}
    @if (config('layout.header.topbar.quick-panel.display'))
        <div class="topbar-item">
            <div class="btn btn-icon btn-clean btn-lg mr-1" id="kt_quick_panel_toggle">
                {{ Metronic::getSVG('media/svg/icons/Layout/Layout-4-blocks.svg', 'svg-icon-xl svg-icon-primary') }}
            </div>
        </div>
    @endif

    {{-- Languages --}}
    <!-- @if (config('layout.extras.languages.display'))
-->
    <!-- <div class="dropdown">
        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
            <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                <img class="h-20px w-20px rounded-sm" src="{{ asset('media/svg/flags/226-united-states.svg') }}" alt="" />
            </div>
        </div>

        <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
            @include('layout.partials.extras.dropdown._languages')
        </div>
    </div> -->
    <!--
@endif -->

    {{-- User --}}
    @php
        if (Auth::guard('web')->check()) {
            $user = Illuminate\Support\Facades\DB::table('user_details')
                ->where('user_id', Auth::user()->id)
                ->select('first_name', 'last_name', 'profile_img')
                ->first();
            $username = $user->first_name . ' ' . $user->last_name;
            $userImg = $user->profile_img;
        } elseif (Auth::guard('employee')->check()) {
            $user = Illuminate\Support\Facades\DB::table('employees')
                ->select('employee_name', 'employee_feature_img')
                ->where('id', Auth::user()->employee_id)
                ->first();
            $username = $user->employee_name;
            $userImg = $user->employee_feature_img;
        }
    @endphp

    @if (config('layout.extras.user.display'))
        @if (config('layout.extras.user.layout') == 'offcanvas')
            <div class="topbar-item">
                <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2"
                    id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    <span
                        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ $username }}</span>
                    <span class="symbol symbol-35 symbol-light-success">
                        @if ($userImg == null)
                            <span
                                class="symbol-label font-size-h5 font-weight-bold">{{ substr($username, 0, 1) }}</span>
                            <i class="symbol-badge bg-success online-badge"></i>
                        @elseif(Auth::guard('web')->check())
                            <img src="{{ asset('storage/users/' . $userImg) }}" alt="" srcset="">
                            <i class="symbol-badge bg-success online-badge"></i>
                        @else
                            <img src="{{ Storage::disk('public')->exists('employees/' . $userImg)? asset('storage/employees/' . $userImg): asset('storage/' . $userImg) }}"
                                alt="" srcset="">
                            <i class="symbol-badge bg-success online-badge"></i>
                        @endif
                    </span>
                </div>
            </div>
        @else
            <div class="dropdown">
                {{-- Toggle --}}
                <div class=" topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2">
                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                        <span
                            class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ $user }}</span>
                        <span class="symbol symbol-35 symbol-light-success">
                            <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                        </span>
                    </div>
                </div>

                {{-- Dropdown --}}
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
                    @include('layout.partials.extras.dropdown._user')
                </div>
            </div>
        @endif
    @endif
</div>
