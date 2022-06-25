<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Summary</title>
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
            border-bottom: 1px solid #000;
            border-right: 1px solid #000;
            border-left: 1px solid #000;
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
                padding-right: 15px;
            }

            .wrapper-A4 {
                padding-bottom: 15px;
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

    @if($request->page == 'thermal')
    <div class="wrapper">
        <div class="hidden-print">
            <table>
                <tr>
                    <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> Print</button></td>
                </tr>
            </table>
            <br>
        </div>

        <div id="receipt-data">
            <div class="centered">
                @php
                Storage::disk('public')->exists('outlets/'.$outlet->outlet_feature_img)?$image=asset('storage/outlets/'.$outlet->outlet_feature_img):$image=''
                @endphp

                @if($image!='')
                <img src="{{$image}}" width="200">
                @else
                <h1>{{$outlet->outlet_title}}</h1>
                @endif



                <p>Address: {{$outlet->outlet_address ?? $outlet->city_name}}
                    <br>Phone Number: {{$outlet->outlet_phone}}
                </p>
            </div>
            <table>
                <tr>
                    <td colspan="2" style="text-align:left;">Date: {{Carbon\Carbon::now()}}</td>
                </tr>
            </table>
            <table style="margin-top: 10px;" class="table-data">
                <thead>
                    <tr>
                        <th colspan="2">Summary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:left">New Products</td>
                        <td style="text-align:left; min-width:100px;">{{count($new_products)}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">New Customers</td>
                        <td style="text-align:left; min-width:100px;">{{$new_customers}}</td>
                    </tr>
                    @if($request->show_id==1)
                    <tr>
                        <td style="text-align:left">Total Profit</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$sales_orders->total_profit??'0.00'}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="text-align:left">Total Expenses</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$expense??'0.00'}}</td>
                    </tr>


                </tbody>

            </table>

            <table style="margin-top: 10px;" class="table-data">
                <thead>
                    <tr>
                        <th colspan="3">
                            Today's Purchase Order Stats
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:left">Requested Orders</td>
                        <td style="text-align:left">{{$purchase_orders->requested??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$purchase_orders->requested_amount??'0'}}</td>
                    </tr>
                    <tr id="profit-row">
                        <td style="text-align:left">In process Orders</td>
                        <td style="text-align:left">{{$purchase_orders->in_process??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$purchase_orders->in_process_amount??'0'}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Shipped Orders</td>
                        <td style="text-align:left">{{$purchase_orders->shipped??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$purchase_orders->shipped_amount??'0'}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Delivered Orders</td>
                        <td style="text-align:left">{{$purchase_orders->delivered??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$purchase_orders->delivered_amount??'0'}}</td>
                    </tr>
                </tbody>

            </table>

            <table style="margin-top: 10px;" class="table-data">
                <thead>
                    <tr>
                        <th colspan="3">
                            Today's Sales Order Stats
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:left">Total Orders</td>
                        <td style="text-align:left">{{$sales_orders->completed??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$sales_orders->completed_amount??'0'}}</td>
                    </tr>
                    <tr id="profit-row">
                        <td style="text-align:left">Orders On Credit</td>
                        <td style="text-align:left">{{$sales_orders->credit??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$sales_orders->credit_amount??'0'}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Orders On Cash</td>
                        <td style="text-align:left">{{$sales_orders->debit??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$sales_orders->debit_amount??'0'}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Orders On Hold</td>
                        <td style="text-align:left">{{$sales_orders->on_hold??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$sales_orders->hold_amount??'0'}}</td>
                    </tr>
                </tbody>

            </table>


            <table>
                <tbody>
                    <tr>
                        <td class="centered" colspan="2">

                            <img style="margin-top:10px; width:150px" src="{{asset('qrcode.png')}}" alt="barcode" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="centered" style="margin:10px 0 50px;">
                Solution by: mgtos.com
            </div>
        </div>
    </div>
    @else
    <div class="wrapper-A4">
        <div class="hidden-print">
            <table>
                <tr>
                    <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> Print</button></td>
                </tr>
            </table>
            <br>
        </div>

        <div id="receipt-data">
            <div class="centered">
                @php
                Storage::disk('public')->exists('outlets/'.$outlet->outlet_feature_img)?$image=asset('storage/outlets/'.$outlet->outlet_feature_img):$image=''
                @endphp

                @if($image!='')
                <img src="{{$image}}" width="200">
                @else
                <h1>{{$outlet->outlet_title}}</h1>
                @endif



                <p>Address: {{$outlet->outlet_address ?? $outlet->city_name}}
                    <br>Phone Number: {{$outlet->outlet_phone}}
                </p>
            </div>
            <table>
                <tr>
                    <td colspan="2" style="text-align:left;">Date: {{Carbon\Carbon::now()}}</td>
                </tr>
            </table>
            <table class="table-data">
                <thead>
                    <tr>
                        <th colspan="2">Summary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:left">New Products</td>
                        <td style="text-align:right">{{count($new_products)}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">New Customers</td>
                        <td style="text-align:left; min-width:100px;">{{$new_customers}}</td>
                    </tr>
                    @if($request->show_id==1)
                    <tr>
                        <td style="text-align:left">Total Profit</td>
                        <td style="text-align:right">PKR {{$sales_orders->total_profit??'0.00'}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="text-align:left">Total Expenses</td>
                        <td style="text-align:right">PKR {{$expense??'0.00'}}</td>
                    </tr>
                </tbody>

            </table>

            <table style="margin-top: 5px;" class="table-data">
                <thead>
                    <tr>
                        <th colspan="3">
                            Today's Purchase Order Stats
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:left">Requested Orders</td>
                        <td style="text-align:left">{{$purchase_orders->requested??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$purchase_orders->requested_amount??'0'}}</td>
                    </tr>
                    <tr id="profit-row">
                        <td style="text-align:left">In process Orders</td>
                        <td style="text-align:left">{{$purchase_orders->in_process??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$purchase_orders->in_process_amount??'0'}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Shipped Orders</td>
                        <td style="text-align:left">{{$purchase_orders->shipped??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$purchase_orders->shipped_amount??'0'}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Delivered Orders</td>
                        <td style="text-align:left">{{$purchase_orders->delivered??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$purchase_orders->delivered_amount??'0'}}</td>
                    </tr>
                </tbody>

            </table>

            <table style="margin-top: 5px;" class="table-data">
                <thead>
                    <tr>
                        <th colspan="3">
                            Today's Sales Order Stats
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:left">Total Orders</td>
                        <td style="text-align:left">{{$sales_orders->completed??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$sales_orders->completed_amount??'0'}}</td>
                    </tr>
                    <tr id="profit-row">
                        <td style="text-align:left">Orders On Credit</td>
                        <td style="text-align:left">{{$sales_orders->credit??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$sales_orders->credit_amount??'0'}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Orders On Cash</td>
                        <td style="text-align:left">{{$sales_orders->debit??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$sales_orders->debit_amount??'0'}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Orders On Hold</td>
                        <td style="text-align:left">{{$sales_orders->on_hold??'0'}}</td>
                        <td style="text-align:left; min-width:100px;">PKR {{$sales_orders->hold_amount??'0'}}</td>
                    </tr>
                </tbody>

            </table>


            <table>
                <tbody>
                    <tr>
                        <td class="centered" colspan="2">

                            <img style="width:150px" src="{{asset('qrcode.png')}}" alt="barcode" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="centered" style="margin:0 50px;">
                Solution by: mgtos.com
            </div>
        </div>
    </div>

    @endif

</body>

</html>