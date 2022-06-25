<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <style type="text/css">
        * {

            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            /* text-transform: capitalize; */
        }

        .wrapper {
            width: 320px;
            margin: 0 auto
        }

        .wrapper-A4 {
            width: 90%;
            margin: 0 auto
        }

        h1 {
            font-size: 20pt;
            margin: 0px;
        }

        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor: pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }

        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }

        .table-data tr {
            /* border-bottom: 1px solid #000; */
            border-right: 1px solid #000;
            border-left: 1px solid #000;
        }

        .table-data tr:last-child {
            border-bottom: 1px solid #000;
        }

        td,
        th {
            padding: 0px 2px;
            width: 50%;
        }

        .table-data td,
        th {
            padding: 7px 2px;
            width: 75%;
        }

        .table-data th {
            border-top: 1px solid #000;
        }

        .wrapper-A4 .table-data td,
        .wrapper-A4 .table-data th {
            padding: 10px;
            border-right: 1px solid #000;
        }

        table {
            width: 100%;
        }

        tfoot tr th:first-child {
            text-align: left;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .left {
            float: left;
            text-align: left;
            align-content: left;
        }

        .right {
            float: right;
            text-align: right;
            align-content: right;
        }

        small {
            font-size: 11px;
        }

        @media print {
            * {
                line-height: 20px;
            }

            .wrapper {
                padding-right: 20px;
            }

            td,
            th {
                padding: 5px 1px;
            }

            .hidden-print {
                display: none !important;
            }

            @page {
                margin: 0;
            }

            /* body {
                padding-left: 0px;
                padding-right: 0px;
                margin-right:0px;
                margin-left: 0px;
            } */

            tbody::after {
                content: '';
                display: block;
                page-break-after: always;
                page-break-inside: always;
                page-break-before: avoid;
            }
        }

    </style>
</head>

<body>
    @if ($request->page == 'thermal' || !$request->page)
        <div class="wrapper">
            <div class="hidden-print">
                <table>
                    <tr>

                        <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i>
                                Print</button></td>
                    </tr>
                </table>
                <br>
            </div>

            <div id="receipt-data">
                <div class="centered">
                    @php
                        Storage::disk('public')->exists('outlets/' . $sales_order->outlet_feature_img) ? ($image = asset('storage/outlets/' . $sales_order->outlet_feature_img)) : ($image = '');
                    @endphp

                    @if ($image != '')
                        <img src="{{ $image }}" width="200">
                        <p>
                            {{ $sales_order->outlet_title }}
                            <br>
                            Address: {{ $sales_order->outlet_address ?? $sales_order->city_name }}
                            <br>Phone Number: {{ $sales_order->outlet_phone }}
                        </p>
                    @else
                        <h1>{{ $sales_order->outlet_title }}</h1>
                        <p>Address: {{ $sales_order->outlet_address ?? $sales_order->city_name }}
                            <br>Phone Number: {{ $sales_order->outlet_phone }}
                        </p>
                    @endif




                </div>
                <table>
                    <tr>
                        <td style="text-align:left; min-width:100px">Invoice #: {{ $sales_order->id }}</td>
                        <td style="text-align:right; min-width:180px">Date: {{ Carbon\Carbon::now() }}</td>
                    </tr>
                    <tr>

                        <th colspan="2"
                            style="text-align:left; font-size:12px; line-height:0px; padding-top:15px !important;">
                            Customer</th>
                    </tr>

                    <tr>
                        <td style="text-align:left;">
                            {{ $sales_order->customer_name ?? 'Walk-In Customer' }}
                        </td>
                        <td style="text-align:right;">{{ $sales_order->customer_phone ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">
                            Payment Method
                        </td>
                        <td style="text-align:right;">{{ $sales_order->payment_method ?? '' }}</td>
                    </tr>
                </table>

                <table style="margin-top: 10px;" class="table-data">
                    <thead>
                        <tr>
                            <th style="text-align:left; min-width:100px">Title</th>
                            <th style="text-align:left;">Price</th>
                            <th style="text-align:left; min-width:50px">Qty.</th>
                            <th style="text-align:left">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales_order->sales_order_detail as $order_detail)
                            @php
                                $product_title = DB::table('products')
                                    ->where('id', $order_detail->product_id)
                                    ->pluck('product_title')
                                    ->first();
                            @endphp
                            <tr>
                                <td>
                                    {{ $product_title }}
                                </td>
                                <td>
                                    {{ $order_detail->retail_price }}
                                </td>
                                <td>
                                    {{ $order_detail->quantity }}
                                </td>
                                <td>
                                    {{ $order_detail->amount_payable }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="3" style="text-align:left">Subtotal</th>
                            <th style="text-align:right">{{ $sales_order->total_bill }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align:left">Tax</th>
                            <th style="text-align:right">{{ $sales_order->so_tax_value }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align:left">Discount</th>
                            <th style="text-align:right">{{ $sales_order->so_discount_value }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align:left">Grand Total</th>
                            <th style="text-align:right">{{ $sales_order->amount_payable }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align:left">Cash Paid:</th>
                            <th style="text-align:right">{{ $sales_order->amount_paid }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align:left">Change:</th>
                            <th style="text-align:right">{{ $sales_order->change_back }}</th>
                        </tr>
                        @if ($sales_order->customer_name)
                            <tr>
                                <th colspan="3" style="text-align:left">Previous Balance: </th>
                                <th style="text-align:right">{{ $customer->balance ?? '0.00' }}</th>
                            </tr>
                        @endif
                        <!-- <tr>
                        <th class="centered" colspan="4">In Words: <span>PKR</span>
                            <span>
                              
                            </span>
                        </th>
                    </tr> -->
                    </tbody>

                </table>
                <table>
                    <tbody>

                        @if ($request->remarks_print == 'on')
                            <tr>
                                <td colspan="2">
                                    Remarks:
                                    <br>
                                    {{ $sales_order->remarks }}
                                </td>
                            </tr>
                        @endif

                        <tr>
                            <td class="centered" colspan="2">Thank you for shopping with us. Please come again</td>
                        </tr>
                        <tr>
                            <td class="centered" colspan="2">

                                <img style="margin-top:10px; width:150px" src="{{ asset('qrcode.png') }}"
                                    alt="barcode" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="centered" style="margin:10px 0 50px;">
                    Solution by: {{ App\Classes\Strings::siteName() }}
                </div>
            </div>
        </div>
    @elseif($request->page == 'a4')
        <div class="wrapper-A4">
            <div class="hidden-print">
                <table>
                    <tr>

                        <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i>
                                Print</button></td>
                    </tr>
                </table>
                <br>
            </div>

            <div id="receipt-data">
                <div class="centered">
                    @php
                        Storage::disk('public')->exists('outlets/' . $sales_order->outlet_feature_img) ? ($image = asset('storage/outlets/' . $sales_order->outlet_feature_img)) : ($image = '');
                    @endphp

                    @if ($image == '')
                        <img src="{{ $image }}" width="50">
                        <p>
                            {{ $sales_order->outlet_title }}
                            <br>
                            Address: {{ $sales_order->outlet_address ?? $sales_order->city_name }}
                            <br>Phone Number: {{ $sales_order->outlet_phone }}
                        </p>
                    @else
                        <h1>{{ $sales_order->outlet_title }}</h1>
                        <p>Address: {{ $sales_order->outlet_address ?? $sales_order->city_name }}
                            <br>Phone Number: {{ $sales_order->outlet_phone }}
                        </p>
                    @endif
                </div>
                <table>
                    <tr style="border: 1px solid #000 !important; border-bottom:none !important;">
                        <td style="text-align:left; min-width:100px;">Invoice #: {{ $sales_order->id }}</td>
                        <td style="text-align:right; min-width:180px">Date: {{ Carbon\Carbon::now() }}</td>
                    </tr>
                    <tr style="border: 1px solid #000 !important; border-top:none !important;">
                        <td style="text-align:left; min-width:100px;">Customer:
                            {{ $sales_order->customer_name ?? 'Walk-In Customer' }}</td>
                        <td style="text-align:right; min-width:180px">Payment Method:
                            {{ $sales_order->payment_method ?? '' }}
                        </td>
                    </tr>
                </table>

                <table style="margin-top: 10px;" class="table-data">
                    <thead>
                        <tr>
                            <th style="text-align:left; min-width:100px">Title</th>
                            <th style="text-align:left;" colspan="2">Price</th>
                            <th style="text-align:left; min-width:50px">Qty.</th>
                            <th style="text-align:left">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales_order->sales_order_detail as $order_detail)
                            @php
                                $product_title = DB::table('products')
                                    ->where('id', $order_detail->product_id)
                                    ->pluck('product_title')
                                    ->first();
                            @endphp
                            <tr>
                                <td>
                                    {{ $product_title }}
                                </td>
                                <td colspan="2">
                                    {{ $order_detail->retail_price }}
                                </td>
                                <td>
                                    {{ $order_detail->quantity }}
                                </td>
                                <td>
                                    {{ $order_detail->amount_payable }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th rowspan="8" style="border-bottom:1px solid #000; " class="centered">
                                Thank you for shopping with us. Please come again
                            </th>
                        </tr>

                        <tr>

                            <th colspan="3" style="text-align:left">Subtotal</th>
                            <th style="text-align:right">{{ $sales_order->total_bill }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align:left">Tax</th>
                            <th style="text-align:right">{{ $sales_order->so_tax_value }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align:left">Discount</th>
                            <th style="text-align:right">{{ $sales_order->so_discount_value }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align:left">Grand Total</th>
                            <th style="text-align:right">{{ $sales_order->amount_payable }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align:left">Cash Paid:</th>
                            <th style="text-align:right">{{ $sales_order->amount_paid }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align:left">Change:</th>
                            <th style="text-align:right">{{ $sales_order->change_back }}</th>
                        </tr>
                        @if ($sales_order->customer_name)
                            <tr>
                                <th colspan="3" style="text-align:left">Previous Balance: </th>
                                <th style="text-align:right">{{ $customer->balance ?? '0.00' }}</th>
                            </tr>
                        @endif
                        <!-- <tr>
                        <th class="centered" colspan="4">In Words: <span>PKR</span>
                            <span>
                              
                            </span>
                        </th>
                    </tr> -->
                    </tbody>

                </table>
                <table>
                    <tbody>
                        <tr>
                            <td class="centered" colspan="2">
                                <img style="margin-top:10px; width:150px" src="{{ asset('qrcode.png') }}"
                                    alt="barcode" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="centered" style="margin:10px 0 50px;">
                    Solution by: {{ App\Classes\Strings::siteName() }}
                </div>
            </div>
        </div>
    @endif



</body>

</html>
