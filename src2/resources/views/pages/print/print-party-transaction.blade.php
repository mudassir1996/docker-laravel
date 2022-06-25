
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
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
            <h3><b>{{ $party_account->outlet_title }}</b></h3>
            <div>
                @if ($party_account->outlet_address != null)
                    {{ $party_account->outlet_address }}
                @else
                    {{ $party_account->city_name }}
                @endif
            </div>
            <div>
                Mobile: {{ $party_account->outlet_phone }}
            </div>
            <br>
            <h5><b>Party Transaction</b></h5>
        </div>

    </div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Supplier Name</th>
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
                <td>{{ $party_account->order_id }}</td>
                <td>{{ $party_account->party_title }}</td>
                <td>{{ $party_account->amount }}</td>
                <td>{{ $party_account->description }}</td>
                <td>{{ $party_account->payment_title }}</td>
                <td>{{ ucfirst($party_account->payment_type_title) }}</td>
                <td>{{ $party_account->payment_date }}</td>
                <td>{{ $party_account->employee_name }}</td>
                <td>{{ $party_account->created_at }}</td>
                <td>{{ $party_account->updated_at }}</td>
            </tr>
        </tbody>
    </table>
    <script>
        window.print();
        window.onafterprint=function(){ window.close();}
    </script>
</body>

</html>
