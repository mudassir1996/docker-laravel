<html>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6WW8MRQRLQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-6WW8MRQRLQ');
    </script>
    
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
                <h2>Products Stock</h2>
            </div>
            <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Stock Keeping</th>
                    <th>SKU</th>
                    <th>Units in stock</th>
                    <th>Minimum Threshold</th>
                    <th>Retail Price</th>
                    <th>Cost Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product_stocks as $product_stock)
                    <tr>
                        <td>{{$product_stock->product_title}}</td>
                        <td>{{$product_stock->stock_keeping?'Yes':'No'}}</td>
                        <td>{{$product_stock->sku}}</td>

                        <td>{{$product_stock->units_in_stock}}</td>

                        <td>
                            {{$product_stock->minimum_threshold}}
                        </td>
                        <td>
                            {{$product_stock->retail_price}}
                        </td>
                        <td>
                            {{$product_stock->cost_price}}
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


