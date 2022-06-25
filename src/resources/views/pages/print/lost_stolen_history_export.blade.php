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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    {{-- Global Theme Styles (used by all pages) --}}
    {{-- @foreach(config('layout.resources.css') as $style)
    <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css" />
    @endforeach --}}
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
                <h2>Lost / Stolen History</h2>
            </div>
            <table class="table">
            <thead>
                <tr>
                    <th>Supplier</th>
                    <th>Quantity</th>
                    <th>Request Date</th>
                    <th>Purchased Date</th>
                    <th>Payment Type</th>
                    <th>Payment Method</th>
                    <th>Discount Value</th>
                    <th>Amount Payable</th>
                    <th>Created By</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($lost_stolen_orders as $order)
                    <tr>
                        <td>{{ $order->supplier_title }}</td>
                        <td>{{ $order->purchased_quantity}}</td>
                        <td>{{ $order->po_request_date }}</td>
                        <td>{{ $order->po_purchased_date }}</td>
                        <td>{{ $order->payment_type }}</td>

                        <td>{{ $order->payment_title }}</td>

                        <td>{{ $order->po_discount_value }}</td>
                        <td>{{ $order->amount_payable }}</td>
                        <td>{{ $order->employee_name }}</td>

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


