<html>

<head>
    <meta charset="utf-8" />
    {{-- Title Section --}}
    <title>{{ config('app.name') }} | Expense Categories</title>

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
            <h2>Expense Categories</h2>
        </div>
        <table class="table table-borderless border border-dark">
            <thead class="border border-dark nowrap">
                <tr>

                    <th class="border-right border-dark align-middle">Title</th>
                    <th class="border-right border-dark align-middle">Description</th>
                    <th class="border-right border-dark align-middle">Created By</th>
                    <th class="border-right border-dark align-middle">Created At</th>
                    <th class="border-right border-dark align-middle">Updated At</th>


                </tr>

            </thead>

            <tbody>

                @if (!$expense_categories->isEmpty())
                    @foreach ($expense_categories as $expense_category)
                        <tr>

                            <td class="border-right border-dark align-middle">{{ $expense_category->title }}</td>
                            <td class="border-right border-dark align-middle">
                                {{ $expense_category->description ?? '-' }}</td>
                            <td class="border-right border-dark align-middle">
                                {{ $expense_category->employee_name }}
                            </td>
                            <td class="border-right border-dark align-middle">{{ $expense_category->created_at }}
                            </td>
                            <td class="border-right border-dark align-middle">{{ $expense_category->updated_at }}
                            </td>

                        </tr>
                    @endforeach

                @endif
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