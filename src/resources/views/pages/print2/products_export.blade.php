<html>
    <head>
    <meta charset="utf-8" />
    {{-- Title Section --}}
    <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon2.png') }}" />

    {{-- Fonts --}}
    {{ Metronic::getGoogleFontsInclude() }}

    {{-- Global Theme Styles (used by all pages) --}}
    @foreach(config('layout.resources.css') as $style)
    <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css" />
    @endforeach
    <style>
        @media print {
            @page{
                /* font-size: 18px; */
                margin-top: 40px;
                margin-bottom: 60px;
            }
            th{
                font-size: 15px !important;
            }
            .footer {
                font-size: 18px;
                position: fixed;
                bottom: 0;
                left: 40%;
            }
        }
    </style>
   
    </head>
    <body>
      
        <div class="container">
             <div style="text-align:right; font-size:14px;">
                Printed at: {{Carbon\Carbon::now()}}
            </div>
            <div style="text-align:center; font-weight:500; font-size:32px;">
                {{$outlet->outlet_title}}
            </div>
            <div style="text-align:center;font-size:18px;">
               {{$outlet->outlet_address??$outlet->city_name}}
               <br>
              Mobile: {{$outlet->outlet_phone}}
            </div>
            <div class="mt-5" style="text-align:center;">
                <h2>Products</h2>
            </div>
            <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Barcode</th>
                    <th>Allow Half</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Company</th>
                    <th>Created By</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->product_title}}</td>
                        <td>{{$product->product_barcode}}</td>
                        <td>{{$product->product_allow_half?'Yes':'No'}}</td>

                        <td>{{$product->product_status}}</td>

                        <td>
                            {{$product->category_title}}
                        </td>
                        <td>
                            {{$product->company_title}}
                        </td>
                        <td>
                            {{$product->employee_name}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       <div class="footer">
           <span>Solution by mgtos.com</span>
       </div>
        </div>

<script>
    window.print();
    window.onafterprint=function(){ window.close();}
</script>
        
    </body>
</html>


