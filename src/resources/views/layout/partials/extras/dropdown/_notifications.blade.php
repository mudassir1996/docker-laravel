{{-- Header --}}
@if (config('layout.extras.notifications.dropdown.style') == 'light')
<div class="d-flex flex-column pt-12 bg-dark-o-5 rounded-top">
    {{-- Title --}}
    <h4 class="d-flex flex-center">
        <span class="text-dark">User Notifications</span>
        <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">23 new</span>
    </h4>

    {{-- Tabs --}}
    <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary mt-3 px-8" role="tablist">
        <li class="nav-item">
            <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications">Alerts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#topbar_notifications_events">Events</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs">Logs</a>
        </li>
    </ul>
</div>
@else
<div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url('{{ asset('media/misc/bg-1.jpg') }}')">
    {{-- Title --}}
    <h4 class="d-flex flex-center rounded-top">
        
        <span class="text-white">User Notifications</span>
        @if ($notifications->where('read_at', null)->count('id')>0)
            <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">
               {{$notifications->where('read_at', null)->count('id')}} New
            </span>
        @endif
       
    </h4>

    {{-- Tabs --}}
    <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
        {{-- <li class="nav-item">
            <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications">Cockpit</a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#topbar_notifications_events">Events</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs">Logs</a>
        </li> --}}
    </ul>
</div>
@endif

{{-- Content --}}
<div class="tab-content">
    {{-- Tabpane --}}
    <div class="tab-pane active show p-4" id="topbar_notifications_notifications" role="tabpanel">
        {{-- Scroll --}}
        <div class="navi">
           
            {{-- Item --}}
            @forelse ($notifications as $notification)
             <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            {{$notification->title}}
                        </div>
                        <div class="text-muted">
                           {{$notification->description}}
                        </div>
                    </div>
                     @php
                        $data=[
                            'notification_id' => $notification->id,
                            'outlet_id' => session('outlet_id')
                        ];
                    @endphp
                    <div class="navi-icon ml-4">
                        @if ($notification->read_at==null)
                            <i class="fas fa-dot-circle text-primary" onclick="markAsRead('{{json_encode($data)}}')" data-toggle="tooltip" title="Mark as read" style="cursor: pointer"></i>
                        @else
                            <i class="far fa-dot-circle text-primary" style="cursor: pointer"></i>
                        @endif
                       
                    </div>
                   
                </div>
            </a>
            
                
            @empty
            <div class="d-flex flex-center text-center text-muted min-h-200px">
                All caught up!
                <br />
                No new notifications.
            </div>
            @endforelse
           
        </div>
        
        
    </div>
      
    {{-- Tabpane --}}
    <div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
        {{-- Nav --}}
        <div class="navi navi-hover scroll my-4" data-scroll="true" data-height="300" data-mobile-height="200">
            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon2-line-chart text-success"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            New report has been received
                        </div>
                        <div class="text-muted">
                            23 hrs ago
                        </div>
                    </div>
                </div>
            </a>

            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon2-paper-plane text-danger"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            Finance report has been generated
                        </div>
                        <div class="text-muted">
                            25 hrs ago
                        </div>
                    </div>
                </div>
            </a>

            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon2-user flaticon2-line- text-success"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            New order has been received
                        </div>
                        <div class="text-muted">
                            2 hrs ago
                        </div>
                    </div>
                </div>
            </a>

            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon2-pin text-primary"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            New customer is registered
                        </div>
                        <div class="text-muted">
                            3 hrs ago
                        </div>
                    </div>
                </div>
            </a>

            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon2-sms text-danger"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            Application has been approved
                        </div>
                        <div class="text-muted">
                            3 hrs ago
                        </div>
                    </div>
                </div>
            </a>

            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon2-pie-chart-3 text-warning"></i>
                    </div>
                    <div class="navinavinavi-text">
                        <div class="font-weight-bold">
                            New file has been uploaded
                        </div>
                        <div class="text-muted">
                            5 hrs ago
                        </div>
                    </div>
                </div>
            </a>

            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon-pie-chart-1 text-info"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            New user feedback received
                        </div>
                        <div class="text-muted">
                            8 hrs ago
                        </div>
                    </div>
                </div>
            </a>

            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon2-settings text-success"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            System reboot has been successfully completed
                        </div>
                        <div class="text-muted">
                            12 hrs ago
                        </div>
                    </div>
                </div>
            </a>

            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon-safe-shield-protection text-primary"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            New order has been placed
                        </div>
                        <div class="text-muted">
                            15 hrs ago
                        </div>
                    </div>
                </div>
            </a>

            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon2-notification text-primary"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            Company meeting canceled
                        </div>
                        <div class="text-muted">
                            19 hrs ago
                        </div>
                    </div>
                </div>
            </a>

            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon2-fax text-success"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            New report has been received
                        </div>
                        <div class="text-muted">
                            23 hrs ago
                        </div>
                    </div>
                </div>
            </a>

            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon-download-1 text-danger"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            Finance report has been generated
                        </div>
                        <div class="text-muted">
                            25 hrs ago
                        </div>
                    </div>
                </div>
            </a>

            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon-security text-warning"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            New customer comment recieved
                        </div>
                        <div class="text-muted">
                            2 days ago
                        </div>
                    </div>
                </div>
            </a>

            {{-- Item --}}
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon2-analytics-1 text-success"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            New customer is registered
                        </div>
                        <div class="text-muted">
                            3 days ago
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Tabpane --}}
    <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
        {{-- Nav --}}
        <div class="d-flex flex-center text-center text-muted min-h-200px">
            All caught up!
            <br />
            No new notifications.
        </div>
    </div>
</div>