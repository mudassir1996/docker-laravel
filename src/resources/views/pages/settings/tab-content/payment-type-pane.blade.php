 <div class="tab-pane fade my-8" id="v-pills-payment-type" role="tabpanel" aria-labelledby="v-pills-payment-type-tab">
     <form action="{{ route('payment-types.store') }}" method="post">
         @csrf
         <!--begin::Teachers-->
         <div class="d-flex flex-row justify-content-center">

             <div class="col-xl-12">
                 <div class="card card-custom bgi-no-repeat gutter-b"
                     style="height:150px; background-position: calc(100% + 0.5rem) 100%; background-size: 50% auto; background-image: url({{ asset('media/svg/patterns/Waimakariri.svg') }})">
                     <!--begin::Body-->
                     <div class="card-body d-flex align-items-center">
                         <div>
                             <h2 class="font-weight-bolder line-height-lg mb-5">
                                 Outlet Payment Types
                                 <p class="text-muted font-weight-bold font-size-sm">
                                     Manage payment types of your outlet
                                 </p>
                             </h2>
                         </div>
                     </div>
                     <!--end::Body-->
                 </div>
             </div>
         </div>
         <div class="d-flex flex-row justify-content-center">

             <div class="col-xl-12">
                 @foreach ($payment_types as $payment_type)
                     <div class="card card-custom mb-5">
                         <!--begin::Body-->
                         <div class="card-body ">
                             <div class="d-flex align-items-center justify-content-between flex-wrap">
                                 <div class="mr-2">
                                     <h3 class="font-weight-bolder text-dark-70">
                                         {{ $payment_type->title }}</h3>
                                 </div>
                                 <div class="font-weight-boldest font-size-h1 text-dark-70">
                                     <span class="switch switch-primary switch-sm switch-icon">
                                         <label>
                                             <input type="checkbox" name="active[]" value="{{ $payment_type->title }}"
                                                 {{ $payment_type->active == 1 ? 'checked' : '' }} />
                                             <span></span>
                                         </label>
                                     </span>
                                 </div>
                             </div>
                             <div class="text-dark-50 font-size-lg mt-2">
                                 {{ $payment_type->description }}</div>
                         </div>

                     </div>
                 @endforeach
                 <div class="text-right">
                     <button type="submit" class="btn btn-primary font-weight-bolder">
                         <i class="fas fa-save icon-sm"></i>Save</button>
                 </div>

             </div>
         </div>
         <!--end::Teachers-->
     </form>
 </div>
