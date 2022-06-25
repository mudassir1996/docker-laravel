<div class="table-responsive">
    <table class="table table-bordered" id="invoice_table">
        <thead>
            <tr>
                @foreach ($invoice_body_headers as $invoice_body_header)
                    <th class="invoice_body_column">
                        @php
                            $column_edit_id=str_replace('.',' ',$invoice_body_header->option);
                        @endphp
                        <span class="{{str_replace(' ','_',$column_edit_id)}}">
                            {{ucfirst($invoice_body_header->value)}}
                        </span>
                        {{-- <input type="text" class="coulmn_edit" id="{{str_replace(' ','_',$column_edit_id)}}" style="display:none;"> --}}
                    </th>                              
                @endforeach
                {{-- @for ($i = 0; $i < count($body_header_custom_fields); $i++)
                    <th class="invoice_body_column">
                        <span class="{{str_replace(' ','_',$body_header_custom_fields[$i])}}">
                            {{ucfirst($body_header_custom_fields[$i])}}
                        </span>
                        
                    </th>     
                @endfor --}}
                {{-- <th colspan="2">Work We've Done For You</th>
                <th>Hours</th>
                <th width="150">Rate</th>
                <th width="150">Total</th> --}}
            </tr>
        </thead>
        <tbody class="text-thin">
            @if (isset($body_data))
               @foreach ($body_data as $item)
                   <tr>
                       @foreach ($item as $data)
                        <td>{{$data}}</td>
                       @endforeach
                   </tr>
               @endforeach
                
            
            @else
            <tr id="inv_row_1">
                @foreach ($invoice_body_headers as $invoice_body_header)
                    <td class="align-middle">
                        
                    </td>                              
                @endforeach
                {{-- @for ($i = 0; $i < count($body_header_custom_fields); $i++)
                    <td class="align-middle">
                        
                    </td>  
                @endfor --}}
            </tr>
            @endif
            
        </tbody>
    </table>
</div>