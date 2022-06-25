<html>

<head>
    <meta charset="utf-8" />
    {{-- Title Section --}}
    <title>{{ config('app.name') }} | Sales Order</title>

    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon2.png') }}" />

    {{-- Fonts --}}
    {{ Metronic::getGoogleFontsInclude() }}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    {{-- Global Theme Styles (used by all pages) --}}
    {{-- @foreach (config('layout.resources.css') as $style)
    <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css" />
    @endforeach --}}
    <style>
        .nowrap {
            white-space: nowrap;
        }

        @media print {
            th {
                font-size: 20px !important;
            }

            .table {
                font-size: 20px !important;
                font-weight: 400 !important;
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

    <div class="container-fluid">
        <div style="text-align:right; font-size:14px;">
            Printed at: {{ Carbon\Carbon::now() }}
        </div>
        <div style="text-align:center; font-weight:500; font-size:32px;">
            {{ $outlet->outlet_title }}
        </div>
        <div style="text-align:center;font-size:18px;">
            {{ $outlet->outlet_address ?? $outlet->city_name }}
            <br>
            Mobile: {{ $outlet->outlet_phone }}
        </div>
        <div class="mt-5" style="text-align:center;">
            <h2>Sales Orders</h2>
        </div>
        <table class="table table-borderless border border-dark ">
            <thead class="border border-dark nowrap">
                <tr>
                    <th class="border-right border-dark align-middle">Order ID</th>
                    <th class="border-right border-dark align-middle">Payment Type</th>
                    <th class="border-right border-dark align-middle">Customer Name</th>
                    <th class="border-right border-dark align-middle">Total Bill</th>
                    <th class="border-right border-dark align-middle">Discount Value</th>
                    <th class="border-right border-dark align-middle">Amount Payable</th>
                    <th class="border-right border-dark align-middle">Order Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales_orders as $order)
                    <tr>
                        <td class="border-right border-dark align-middle">{{ $order->id }}</td>
                        <td class="border-right border-dark align-middle">{{ $order->payment_type_title }}</td>
                        <td class="border-right border-dark align-middle">{{ $order->customer_name }}</td>
                        <td class="border-right border-dark align-middle">{{ $order->total_bill }}</td>

                        <td class="border-right border-dark align-middle">{{ $order->so_discount_value }}</td>

                        <td class="border-right border-dark align-middle">
                            {{ $order->amount_payable }}
                        </td>
                        <td class="border-right border-dark align-middle">
                            {{ $order->order_completion_date }}
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
        window.onafterprint = function() {
            window.close();
        }
    </script>

</body>

</html>
