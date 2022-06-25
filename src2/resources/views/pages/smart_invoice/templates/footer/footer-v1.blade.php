<div class="row justify-content-between invoice-thanks">
    <div class="col-xl-6 col-8">
        @if (count($invoice_footers->where('option','remarks_label'))>0)
            <span id="remarks_label">{{$invoice_footers->where('option','remarks_label')->first()->value}}</span>:
        @endif
        @if (count($invoice_footers->where('option','remarks_value'))>0)
            <div class="title" id="remarks_value">{{$invoice_footers->where('option','remarks_value')->first()->value}}</div>
        @endif
    </div>
    <div class="col-xl-6 col-4">
        <table class="table table-bordered invoice-table-total">
            <tbody>
                <tr>
                    @if (count($invoice_footers->where('option','sub_total_label'))>0)
                    <td class="text-muted text-thin" ><span id="sub_total_label">{{$invoice_footers->where('option','sub_total_label')->first()->value}}</span>:</td>
                    @endif
                    @if (count($invoice_footers->where('option','sub_total_value'))>0)
                    <td class="text-muted text-thin" ><span id="sub_total_value">{{$invoice_footers->where('option','sub_total_value')->first()->value}}</span></td>
                    @endif
                    
                </tr>
                    {{-- <span id="remarks_label"></span>: --}}
                
                <tr>
                    @if (count($invoice_footers->where('option','discount_label'))>0)
                    <td class="text-muted text-thin" ><span id="discount_label">{{$invoice_footers->where('option','discount_label')->first()->value}}</span>:</td>
                    @endif
                    @if (count($invoice_footers->where('option','discount_value'))>0)
                    <td class="text-muted text-thin" ><span id="discount_value">{{$invoice_footers->where('option','discount_value')->first()->value}}</span></td>
                    @endif
                </tr>
                <tr>
                    @if (count($invoice_footers->where('option','discount_percentage_label'))>0)
                    <td class="text-muted text-thin" ><span id="discount_percentage_label">{{$invoice_footers->where('option','discount_percentage_label')->first()->value}}</span>:</td>
                    @endif
                    @if (count($invoice_footers->where('option','discount_percentage_value'))>0)
                    <td class="text-muted text-thin" ><span id="discount_percentage_value">{{$invoice_footers->where('option','discount_percentage_value')->first()->value}}</span></td>
                    @endif
                </tr>
                <tr>
                    @if (count($invoice_footers->where('option','arrears_label'))>0)
                    <td class="text-muted text-thin" ><span id="arrears_label">{{$invoice_footers->where('option','arrears_label')->first()->value}}</span>:</td>
                    @endif
                    @if (count($invoice_footers->where('option','arrears_value'))>0)
                    <td class="text-muted text-thin" ><span id="arrears_value">{{$invoice_footers->where('option','arrears_value')->first()->value}}</span></td>
                    @endif
                </tr>
                <tr>
                    @if (count($invoice_footers->where('option','outstanding_amount_label'))>0)
                    <td class="text-muted text-thin" ><span id="outstanding_amount_label">{{$invoice_footers->where('option','outstanding_amount_label')->first()->value}}</span>:</td>
                    @endif
                    @if (count($invoice_footers->where('option','outstanding_amount_value'))>0)
                    <td class="text-muted text-thin" ><span id="outstanding_amount_value">{{$invoice_footers->where('option','outstanding_amount_value')->first()->value}}</span></td>
                    @endif
                </tr>
                
                <tr class="invoice-table-highlight">
                    @if (count($invoice_footers->where('option','amount_payable_label'))>0)
                    <td class="font-weight-bold" ><span id="amount_payable_label">{{$invoice_footers->where('option','amount_payable_label')->first()->value}}</span>:</td>
                    @endif
                    @if (count($invoice_footers->where('option','amount_payable_value'))>0)
                    <td class="font-weight-bold" ><span id="amount_payable_value">{{$invoice_footers->where('option','amount_payable_value')->first()->value}}</span></td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>