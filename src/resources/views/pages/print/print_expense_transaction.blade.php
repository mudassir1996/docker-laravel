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

    <header class="text-right">
        <p><b>Printed at:</b> <span>{{ Carbon\Carbon::now() }}</span></p>
    </header>
    <br>
    <div class="container">
        <div class="text-center">
            <h3><b>{{ $outlet->outlet_title }}</b></h3>
            <div>
                @if ($outlet->outlet_address != null)
                    {{ $outlet->outlet_address }}
                @else
                    {{ $outlet->city_name }}
                @endif
            </div>
            <div>
                Mobile: {{ $outlet->outlet_phone }}
            </div>
            <br>
            <h5><b>Expense Transaction</b></h5>
        </div>

    </div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Expense Title</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Payment Method</th>
                <th>Payment Type</th>

                <th>Created By</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            <tr>

                <td>{{ $expense_transaction->title }}</td>
                <td>{{ $expense_transaction->amount }}</td>
                <td>{{ $expense_transaction->description }}</td>
                <td>{{ $expense_transaction->payment_method }}</td>
                <td>{{ ucfirst($expense_transaction->payment_type_title) }}</td>

                <td>{{ $expense_transaction->employee_name }}</td>
                <td>{{ $expense_transaction->created_at }}</td>
                <td>{{ $expense_transaction->updated_at }}</td>
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
