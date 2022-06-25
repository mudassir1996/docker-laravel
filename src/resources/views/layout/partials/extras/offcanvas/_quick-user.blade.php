@php
$direction = config('layout.extras.user.offcanvas.direction', 'right');
@endphp
{{-- User Panel --}}
<div id="kt_quick_user" class="offcanvas offcanvas-{{ $direction }} p-10">
    {{-- Header --}}
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">
            User Profile
            {{-- <small class="text-muted font-size-sm ml-2">12 messages</small> --}}
        </h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>

    {{-- Content --}}
    <div class="offcanvas-content pr-5 mr-n5">
        {{-- Header --}}
        @php
            if (Auth::guard('web')->check()) {
                $position = 'Outlet Owner';
                $user = Illuminate\Support\Facades\DB::table('user_details')
                    ->where('user_id', Auth::user()->id)
                    ->select('first_name', 'last_name', 'profile_img')
                    ->first();
                $username = $user->first_name . ' ' . $user->last_name;
            } elseif (Auth::guard('employee')->check()) {
                $position = 'Outlet Employee';
                $user = Illuminate\Support\Facades\DB::table('employees')
                    ->select('employee_name', 'employee_feature_img')
                    ->where('id', Auth::user()->employee_id)
                    ->first();
                $username = $user->employee_name;
                $userImg = $user->employee_feature_img;
            }
        @endphp

        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-75 symbol-light-success mr-5">
                @if (Auth::guard('web')->check() && $user->profile_img == null)
                    <h1 class="symbol-label display-3">{{ substr($username, 0, 1) }}</h1>
                    <i class="symbol-badge bg-success online-badge"></i>
                @elseif(Auth::guard('web')->check())
                    <img src="{{ asset('storage/users/' . $user->profile_img) }}" alt="" srcset="">
                    <i class="symbol-badge bg-success online-badge"></i>
                @elseif(!Auth::guard('web')->check())
                    <img src="{{ Storage::disk('public')->exists('employees/' . $userImg)? asset('storage/employees/' . $userImg): asset('storage/' . $userImg) }}"
                        alt="" srcset="">
                    <i class="symbol-badge bg-success online-badge"></i>
                @endif
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">

                    {{ $username }}
                </a>
                <div class="text-muted mt-1">
                    {{ $position }}
                </div>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">


                            @if (Auth::guard('web')->check())
                                @if (is_numeric(auth()->user()->username))
                                    <span class="navi-icon">
                                        <i class="flaticon2-phone"></i>
                                    </span>
                                    <span class="navi-text text-muted text-hover-primary">
                                        +{{ Auth::user()->username }}</span>
                                @elseif (filter_var(auth()->user()->username, FILTER_VALIDATE_EMAIL))
                                    <span class="navi-icon mr-1">
                                        {{ Metronic::getSVG('media/svg/icons/Communication/Mail-notification.svg', 'svg-icon-lg svg-icon-primary') }}
                                    </span>
                                    <span class="navi-text text-muted text-hover-primary">
                                        {{ Auth::user()->username }}</span>
                                @endif
                            @else
                                <span class="navi-icon mr-1">
                                    {{ Metronic::getSVG('media/svg/icons/Communication/Mail-notification.svg', 'svg-icon-lg svg-icon-primary') }}
                                </span>
                                <span class="navi-text text-muted text-hover-primary">
                                    {{ Auth::user()->email }}</span>
                            @endif


                        </span>
                    </a>
                </div>

            </div>


        </div>
        <div class="row">
            <div class="col-12 text-center">
                <form id="logout-form"
                    action="{{ auth()->guard('employee')->check()? route('employee.logout'): route('logout') }}"
                    method="POST">
                    @csrf
                    <input type="submit" value="Logout" class="mt-5 btn btn-light-info btn-sm w-100">
                </form>

            </div>
        </div>

        {{-- Separator --}}
        <div class="separator separator-dashed mt-8 mb-5"></div>

        {{-- Nav --}}
        <div class="navi navi-spacer-x-0 p-0">

            {{-- Item --}}
            @if (!Auth::guard('web')->check())
                @can('outlet_create')
                    <a href="{{ route('outlets.create') }}" class="navi-item">
                        <div class="navi-link">
                            <div class="symbol symbol-40 bg-light mr-3">
                                <div class="symbol-label">
                                    {{ Metronic::getSVG('media/svg/icons/Shopping/Cart2.svg', 'svg-icon-md svg-icon-warning') }}
                                </div>
                            </div>
                            <div class="navi-text">
                                <div class="font-weight-bold">
                                    Add Outlet
                                </div>
                                <div class="text-muted">
                                    Add new outlet.
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan
            @else
                <a href="{{ route('outlets.create') }}" class="navi-item">
                    <div class="navi-link">
                        <div class="symbol symbol-40 bg-light mr-3">
                            <div class="symbol-label">
                                {{ Metronic::getSVG('media/svg/icons/Shopping/Cart2.svg', 'svg-icon-md svg-icon-warning') }}
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold">
                                Add Outlet
                            </div>
                            <div class="text-muted">
                                Add new outlet.
                            </div>
                        </div>
                    </div>
                </a>
            @endif
            {{-- Item --}}
            @if (!Auth::guard('web')->check())
                @can('user_profile_edit')
                    <a href="{{ route('users.edit', Auth::user()->id) }}" class="navi-item">
                        <div class="navi-link">
                            <div class="symbol symbol-40 bg-light mr-3">
                                <div class="symbol-label">
                                    {{ Metronic::getSVG('media/svg/icons/General/User.svg', 'svg-icon-md svg-icon-success') }}
                                </div>
                            </div>
                            <div class="navi-text">
                                <div class="font-weight-bold">
                                    My Profile
                                </div>
                                <div class="text-muted">
                                    Account settings and more
                                    <!-- <span class="label label-light-danger label-inline font-weight-bold">update</span> -->
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan
            @else
                <a href="{{ route('users.edit', Auth::user()->id) }}" class="navi-item">
                    <div class="navi-link">
                        <div class="symbol symbol-40 bg-light mr-3">
                            <div class="symbol-label">
                                {{ Metronic::getSVG('media/svg/icons/General/User.svg', 'svg-icon-md svg-icon-success') }}
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold">
                                My Profile
                            </div>
                            <div class="text-muted">
                                Account settings and more
                                <!-- <span class="label label-light-danger label-inline font-weight-bold">update</span> -->
                            </div>
                        </div>
                    </div>
                </a>
            @endif

            @php
                $premium = DB::table('subscriptions')
                    ->where('outlet_id', session('outlet_id'))
                    ->where('subscription_status', 'verified')
                    ->whereDate('subscription_start_date', '<=', Carbon\Carbon::today()->format('Y-m-d h:i:s'))
                    ->whereDate('subscription_end_date', '>=', Carbon\Carbon::today()->format('Y-m-d h:i:s'))
                    ->first();
            @endphp
        </div>
    </div>
</div>
