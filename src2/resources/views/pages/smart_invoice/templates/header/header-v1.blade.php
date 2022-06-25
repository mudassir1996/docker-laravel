<div class="invoice-container py-7">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-lg-offset-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="invoice-company {{count($invoice_headers->where('option','outlet_logo'))>0?'':'pl-0'}} ">
                        
                        @if(count($invoice_headers->where('option','outlet_logo'))>0)
                            @if (isset($outlet))
                                <img id="outlet_logo" src="{{Storage::disk('public')->exists('outlets/'.$outlet->outlet_feature_img)?asset('storage/outlets/'.$outlet->outlet_feature_img):asset('storage/placeholder.jpg')}}" width="80" height="80"
                                alt="">
                            @elseif ($invoice_headers->where('option','outlet_logo')->first()->value != '')
                                <img id="outlet_logo" src="{{Storage::disk('public')->exists('smart-invoice/logo/'.$invoice_headers->where('option','outlet_logo')->first()->value)?asset('storage/smart-invoice/logo/'.$invoice_headers->where('option','outlet_logo')->first()->value):asset('storage/'.$invoice_headers->where('option','outlet_logo')->first()->value)}}" width="80" height="80"
                                alt="">
                            @else
                                <img id="outlet_logo" src="{{asset('storage/placeholder.jpg')}}" width="80" height="80"
                                alt="">
                            @endif
                        @endif
                        
                        @if(count($invoice_headers->where('option','outlet_title'))>0)
                            <h2 id="outlet_title" class="mt-0">{{$invoice_headers->where('option','outlet_title')->first()->value}}</h2>
                        @endif

                        @if(count($invoice_headers->where('option','outlet_address'))>0)
                            <p class="mb-0" id="outlet_address">{{$invoice_headers->where('option','outlet_address')->first()->value}}</p>
                        @endif

                        @if(count($invoice_headers->where('option','outlet_phone'))>0)
                            <p class="mb-0" id="outlet_phone">{{$invoice_headers->where('option','outlet_phone')->first()->value}}</p>
                        @endif
                        
                        @if(count($invoice_headers->where('option','outlet_email'))>0)
                            <p class="mb-0" id="outlet_email">{{$invoice_headers->where('option','outlet_email')->first()->value}}</p>
                        @endif
                       
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="invoice-number text-right">
                        @if(count($invoice_headers->where('option','ref_no_label'))>0)
                            <p class="mb-0" id="ref_no_label">{{$invoice_headers->where('option','ref_no_label')->first()->value}}</p>
                        @endif
                        @if(count($invoice_headers->where('option','ref_no_value'))>0)
                            <h3 class="mt-0" id="ref_no_value">{{$invoice_headers->where('option','ref_no_value')->first()->value}}</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="invoice-container invoice-container-highlight py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-lg-offset-2 font-size-lg" >
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="invoice-address">
                        <div class="row">
                            <div class="col-6">
                                @if (count($invoice_headers->where('option','invoice_date_label'))>0)
                                    <span id="invoice_date_label">{{$invoice_headers->where('option','invoice_date_label')->first()->value}}</span>:
                                @endif
                                
                                @if (count($invoice_headers->where('option','invoice_date_value'))>0)
                                    <b id="invoice_date_value">{{$invoice_headers->where('option','invoice_date_value')->first()->value}}</b>
                                @endif
                            </div>

                            <div class="col-6 text-right">
                                @if (count($invoice_headers->where('option','invoice_due_date_label'))>0)
                                    <span id="invoice_due_date_label">{{$invoice_headers->where('option','invoice_due_date_label')->first()->value}}</span>:
                                @endif
                                
                                @if (count($invoice_headers->where('option','invoice_due_date_value'))>0)
                                    <b id="invoice_due_date_value">{{$invoice_headers->where('option','invoice_due_date_value')->first()->value}}</b>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="invoice-address">
                        <div class="row">
                            <div class="col-6">
                                <p>
                                    @if (count($invoice_headers->where('option','customer_name_label'))>0)
                                        <span id="customer_name_label">{{$invoice_headers->where('option','customer_name_label')->first()->value}}</span>:
                                    @endif
                                    
                                    @if (count($invoice_headers->where('option','customer_name_value'))>0)
                                        <b id="customer_name_value">{{$invoice_headers->where('option','customer_name_value')->first()->value}}</b>
                                    @endif
                                    
                                </p>
                                <p>
                                    @if (count($invoice_headers->where('option','customer_address_label'))>0)
                                        <span id="customer_address_label">{{$invoice_headers->where('option','customer_address_label')->first()->value}}</span>:
                                    @endif
                                    
                                    @if (count($invoice_headers->where('option','customer_address_value'))>0)
                                        <b id="customer_address_value">{{$invoice_headers->where('option','customer_address_value')->first()->value}}</b>
                                    @endif
                                    
                                </p>
                                <p>
                                    @if (count($invoice_headers->where('option','customer_phone_label'))>0)
                                        <span id="customer_phone_label">{{$invoice_headers->where('option','customer_phone_label')->first()->value}}</span>:
                                    @endif
                                    
                                    @if (count($invoice_headers->where('option','customer_phone_value'))>0)
                                        <b id="customer_phone_value">{{$invoice_headers->where('option','customer_phone_value')->first()->value}}</b>
                                    @endif
                                </p>
                            </div>
                            <div class="col-6 text-right">
                                @if (isset($header_custom_fields))
                                    @foreach ($header_custom_fields as $header_custom_field)
                                        <p>
                                            @php
                                                $header_custom_field_id=str_replace('.',' ',$header_custom_field);
                                                $header_custom_field_id=str_replace(' ','_',$header_custom_field_id);
                                            @endphp
                                            <span>{{$header_custom_field}}</span>:
                                            <b id="{{$header_custom_field_id}}"></b>
                                            
                                        </p>
                                    @endforeach
                                @endif
                                @if(isset($invoice_custom_headers))
                                    @foreach ($invoice_custom_headers as $invoice_custom_header)
                                        <p>
                                            <span>{{$invoice_custom_header->option}}</span>:
                                            <b id="{{$invoice_custom_header->option}}">{{$invoice_custom_header->value}}</b>
                                        </p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>