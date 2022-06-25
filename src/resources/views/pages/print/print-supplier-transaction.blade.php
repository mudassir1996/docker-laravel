<!DOCTYPE html>
<html lang="en">

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

    <header class="text-right">
        <p><b>Printed at:</b> <span>{{ Carbon\Carbon::now() }}</span></p>
    </header>
    <br>
    <div class="container">
        <div class="text-center">
            <h3><b>{{ $supplier_account->outlet_title }}</b></h3>
            <div>
                @if ($supplier_account->outlet_address != null)
                    {{ $supplier_account->outlet_address }}
                @else
                    {{ $supplier_account->city_name }}
                @endif
            </div>
            <div>
                Mobile: {{ $supplier_account->outlet_phone }}
            </div>
            <br>
            <h2>Supplier Transaction</h2>
        </div>

    </div>
    <br>
    <table class="table table-borderless border border-dark ">
        <thead class="border border-dark nowrap">
            <tr>
                <th class="border-right border-dark align-middle">Order ID</th>
                <th class="border-right border-dark align-middle">Supplier Name</th>
                <th class="border-right border-dark align-middle">Amount</th>
                <th class="border-right border-dark align-middle">Description</th>
                <th class="border-right border-dark align-middle">Payment Method</th>
                <th class="border-right border-dark align-middle">Payment Type</th>
                <th class="border-right border-dark align-middle">Payment Date</th>
                <th class="border-right border-dark align-middle">Created By</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border-right border-dark align-middle">{{ $supplier_account->order_id }}</td>
                <td class="border-right border-dark align-middle">{{ $supplier_account->supplier_title }}</td>
                <td class="border-right border-dark align-middle">{{ $supplier_account->amount }}</td>
                <td class="border-right border-dark align-middle">{{ $supplier_account->description }}</td>
                <td class="border-right border-dark align-middle">{{ $supplier_account->payment_title }}</td>
                <td class="border-right border-dark align-middle">
                    {{ ucfirst($supplier_account->payment_type_title) }}
                </td>
                <td class="border-right border-dark align-middle">{{ $supplier_account->payment_date }}</td>
                <td class="border-right border-dark align-middle">{{ $supplier_account->employee_name }}</td>

            </tr>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        window.print();
        window.onafterprint = function() {
            window.close();
        }
    </script>
</body>

</html>
