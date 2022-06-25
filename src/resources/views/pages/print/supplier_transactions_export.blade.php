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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <style>
        @media print {
            .nowrap {
                white-space: nowrap;
            }

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
            <h2>Supplier Transactions</h2>
        </div>
        <table class="table table-borderless border border-dark ">
            <thead class="border border-dark nowrap">

                <tr>
                    <th class="border-right border-dark align-middle">Transaction Date</th>
                    <th class="border-right border-dark align-middle">Description</th>
                    <th class="border-right border-dark align-middle">Ammount</th>
                    <th class="border-right border-dark align-middle">Transaction Type</th>
                    <th class="border-right border-dark align-middle">Balance</th>
                </tr>
            </thead>
            <tbody>
                @if (!$supplier_transactions->isEmpty())
                    @foreach ($supplier_transactions as $supplier_transaction)
                        <tr>

                            <td class="border-right border-dark align-middle">
                                {{ date('D, d M Y', strtotime($supplier_transaction->payment_date)) }}</td>
                            <td class="border-right border-dark align-middle">
                                {{ substr($supplier_transaction->description, 0, 40) }}...</td>
                            <td class="border-right border-dark align-middle">{{ $supplier_transaction->amount }}
                            </td>
                            <td class="border-right border-dark align-middle">
                                {{ ucfirst($supplier_transaction->payment_type_title) }}</td>
                            <td class="border-right border-dark align-middle">{{ $supplier_transaction->balance }}
                            </td>

                        </tr>
                    @endforeach
                @endif

            </tbody>
            <tfoot>
                @if (!$supplier_transactions->isEmpty())
                    <tr class="border-top border-dark">
                        <td class="font-weight-bolder border-right border-dark align-middle">
                            {{ date('D, d M Y', strtotime($supplier_transactions->last()->payment_date)) }}</td>
                        <td class="font-weight-bolder border-right border-dark align-middle" colspan="3">Closing Balance
                        </td>

                        <td class="font-weight-bolder border-right border-dark align-middle">
                            {{ $supplier_transactions->last()->balance }}</td>

                    </tr>
                @endif
            </tfoot>

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
