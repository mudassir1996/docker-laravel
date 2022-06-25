@extends('layout.default')
@section('title', 'Ticket Response')
@section('content')


<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Support Tickets</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{route('tickets.index')}}" class="text-muted">All Tickets</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-muted">Ticket Response</a>
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
       
       <div class="card card-custom">
           <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="d-flex align-items-center mt-8 mb-8">
                            <!--begin::Content-->
                            <div class="d-flex flex-column">
                                <!--begin::Title-->
                                <h1 class="text-gray-800 fw-bold">{{$ticket->title}}</h1>
                                <!--end::Title-->
                                <!--begin::Info-->
                                <div class="">
                                    <!--begin::Label-->
                                    <span class="font-weight-bold text-muted mr-6">Status: 
                                        @if($ticket->status == 'processing')
                                            <span class="label font-weight-bold label-lg  label-light-warning label-inline">{{ucfirst($ticket->status)}}</span>
                                            
                                            @elseif($ticket->status == 'open')
                                            <span class="label font-weight-bold label-lg  label-light-success label-inline">{{ucfirst($ticket->status)}}</span>
                                            
                                            @elseif($ticket->status == 'closed')
                                            <span class="label font-weight-bold label-lg  label-light-danger label-inline">{{ucfirst($ticket->status)}}</span>
                                        @endif
                                    </span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Content-->
                        </div>
                       
                        <div class="mb-9 px-10">
                            <!--begin::Card-->
                            <div class="card card-bordered w-100">
                                <!--begin::Body-->
                                <div class="card-body pb-2 p-0">
                                    <div class="card-header bg-dark pb-2 pt-2 p-0">
                                        <!--begin::Wrapper-->
                                        <div class="w-100 d-flex ml-2 flex-stack">
                                            
                                            <!--begin::Container-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Author-->
                                                <div class="symbol symbol-40 mr-5">
                                                    @php
                                                        
                                                        $ticket_employee_image = $ticket->employee_feature_img;
                                                                                                               
                                                    @endphp

                                                    @if ($ticket_employee_image !='' && $ticket_employee_image != 'placeholder.jpg')
                                                            <img src="{{asset('storage/employees/'.$ticket_employee_image)}}" alt="">
                                                    @else
                                                        <div class="symbol-label font-size-h2 font-weight-bolder bg-light text-dark">
                                                            {{substr($ticket->employee_name,0,1)}}
                                                        </div>
                                                    @endif

                                                    
                                                    
                                                </div>
                                                <!--end::Author-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column font-weight-bold font-size-h5 text-dark">
                                                    <!--begin::Text-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Username-->
                                                        <a class="text-light mr-3">
                                                            Me 
                                                        </a>
                                                        <span class="text-muted font-weight-bold font-size-sm">created on: {{$ticket->created_at}}</span>
                                                        <!--end::Username-->
                                                        <span class="m-0"></span>
                                                    </div>
                                                    <!--end::Text-->
                                                    
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::Container-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--begin::Desc-->
                                    <p class="my-4 px-4">{{$ticket->description}}</p>
                                    <!--end::Desc-->
                                    
                                    @if ($ticket->featured_img != 'placeholder.jpg')
                                        <div class="">
                                            <a href="{{$ticket->featured_img}}" target="_blank">
                                                <img class="card-rounded w-50 ml-2" src="{{$ticket->featured_img}}" alt="" srcset="">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                         @if (count($ticket->ticket_response))
                             <h3 class="my-10 px-10 text-muted"> {{count($ticket->ticket_response)}} {{count($ticket->ticket_response)==1?"Response":"Responses"}}</h3>
                         @endif
                        <div class="mb-15 px-10">
                            @foreach ($ticket->ticket_response as $ticket_response)
                                @php
                                    $sender=DB::table('employees')
                                    ->where('id',$ticket_response->created_by)
                                    ->select('employee_name', 'employee_feature_img')
                                    ->first();
                                   $sender_employee_image = $sender->employee_feature_img;

                                   
                                    if($ticket_response->status == 'client'){
                                        $sender_name = 'Me';
                                    }else{
                                        $sender_name= DB::table('admins')->where('id', $ticket_response->created_by)->pluck('name')->first();
                                    }
                                    @endphp
                                    {{-- {{$sender_name}} --}}
                                {{-- {{dd($ticket_response->created_by)}} --}}
                                
                                <!--begin::Comment-->
                            <div class="mb-9">
                                <!--begin::Card-->
                                <div class="card card-bordered w-100">
                                    <!--begin::Body-->
                                    <div class="card-body pb-2 p-0">
                                        <div class="card-header bg-light pb-2 pt-2 p-0">
                                            <!--begin::Wrapper-->
                                            <div class="w-100 d-flex ml-2 flex-stack">
                                               
                                                <!--begin::Container-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Author-->
                                                    <div class="symbol symbol-light-success symbol-40 mr-5">
                                                    @if ($sender_employee_image !='' && $sender_employee_image != 'placeholder.jpg')
                                                        <img src="{{asset('storage/employees/'.$sender_employee_image)}}" alt="">
                                                    @else
                                                        <div class="symbol-label font-size-h2 font-weight-bolder text-dark">
                                                           
                                                            @if($ticket_response->status == 'client')
                                                                {{substr($sender->employee_name,0,1)}}
                                                            @else
                                                                {{substr($sender_name,0,1)}}
                                                            @endif
                            
                                                        </div>
                                                    @endif
                                                       
                                                    </div>
                                                    <!--end::Author-->
                                                    <!--begin::Info-->
                                                    <div class="d-flex flex-column font-weight-bold font-size-h5 text-dark">
                                                        <!--begin::Text-->
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Username-->
                                                            <a class="text-dark-75 mr-3">
                                                                {{$sender_name}}   
                                                            </a>
                                                            <span class="text-muted font-weight-bold font-size-sm">commented on: {{$ticket_response->created_at}}</span>
                                                            <!--end::Username-->
                                                            <span class="m-0"></span>
                                                        </div>
                                                        <!--end::Text-->
                                                       
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Container-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--begin::Desc-->
                                        <p class="my-4 px-4 mr-0">{{$ticket_response->response}}</p>
                                        <!--end::Desc-->
{{-- {{$ticket_response->featured_img}} --}}
                                       @if ($ticket_response->featured_img != 'placeholder.jpg')
                                        <div class="">
                                            <a href="{{$ticket_response->featured_img}}" target="_blank">
                                                <img class="card-rounded w-50 ml-2" src="{{$ticket_response->featured_img}}" alt="" srcset="">
                                            </a>
                                        </div>
                                    @endif
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Comment-->
                                
                            @endforeach

                            @if ($ticket->status != 'closed')
                                <!--begin::Input group-->
                            <div class="mb-0">
                                <form action="{{route('ticket_response.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <textarea class="form-control placeholder-gray-600 font-size-h6 pr-9 pt-7" rows="6" name="response" placeholder="Leave a comment" ></textarea>
                                    {{-- <div id="kt_quil_1"></div> --}}
                                    
                                    <div class="image-input image-input-outline mt-4" id="kt_image_1">
                                        <div class="image-input-wrapper" style="background-image: url({{asset('storage/placeholder.jpg')}})"></div>
                                    
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="featured_img" accept=".jpg, .png"/>
                                        {{-- <input type="hidden" name="profile_avatar_remove"/> --}}
                                        </label>
                                    
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                    @error('featured_img')
                                    {{$message}}
                                    @enderror
                                    <input type="hidden" value="{{$ticket->id}}" name="ticket_id">
                                    <input type="hidden" value="client" name="status">
                                  
                                    <input type="hidden" name="created_by" value="{{session('employee_id')}}">
                                    <!--begin::Submit-->
                                    <button type="submit" class="btn btn-primary mt-4 float-right px-12">Send</button>
                                    <!--end::Submit-->
                                </form>
                            </div>
                            <!--end::Input group-->
                            @endif
                            
                            
                        </div>
                    </div>
                </div>
           </div>
       </div>
        
        
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->



@endsection

{{-- Styles Section --}}
<!-- @section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection -->


{{-- Scripts Section --}}

@section('scripts')
<script>
    var avatar1 = new KTImageInput('kt_image_1');
</script>
<script src="{{asset('js/suppliers/form_validation.js')}}"></script>



@endsection