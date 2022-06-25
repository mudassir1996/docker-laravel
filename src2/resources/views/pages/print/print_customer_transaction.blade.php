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
            <h3><b>{{ $customer_account->outlet_title }}</b></h3>
            <div>
                @if ($customer_account->outlet_address != null)
                    {{ $customer_account->outlet_address }}
                @else
                    {{ $customer_account->city_name }}
                @endif
            </div>
            <div>
                Mobile: {{ $customer_account->outlet_phone }}
            </div>
            <br>
            <h5><b>Customer Transaction</b></h5>
        </div>

    </div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Payment Method</th>
                <th>Payment Type</th>
                <th>Payment Date</th>
                <th>Created By</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $customer_account->order_id }}</td>
                <td>{{ $customer_account->customer_name }}</td>
                <td>{{ $customer_account->amount }}</td>
                <td>{{ $customer_account->description }}</td>
                <td>{{ $customer_account->payment_title }}</td>
                <td>{{ ucfirst($customer_account->payment_type_title) }}</td>
                <td>{{ $customer_account->payment_date }}</td>
                <td>{{ $customer_account->employee_name }}</td>
                <td>{{ $customer_account->created_at }}</td>
                <td>{{ $customer_account->updated_at }}</td>
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
