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
    <style>
        @media print {
            @page {
                /* font-size: 18px; */
                margin-top: 40px;
                margin-bottom: 60px;
            }

            th {
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
            <h2>Parties</h2>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Party</th>
                    <th>Description</th>
                    <th>Reg. No</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Allow Credit</th>
                    <th>Created By</th>
                    <th>Created At</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($parties as $party)
                <tr>
                    <td>{{ $party->party_title }}</td>
                    <td>{{ $party->party_description}}</td>
                    <td>{{ $party->party_regno }}</td>
                    <td>{{ $party->party_address }}</td>
                    <td>{{ $party->party_email }}</td>
                    <td>{{ $party->party_phone }}</td>
                    <td>{{$party->allow_credit?'Yes':'No'}}</td>
                    <td>{{ $party->employee_name }}</td>
                    <td>{{ $party->created_at }}</td>

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