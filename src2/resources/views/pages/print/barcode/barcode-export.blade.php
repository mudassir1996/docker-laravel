<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <style>
        @page {
            size: 50 25mm;
            overflow: hidden;
        }
        body.receipt .sheet {
            width: 50mm;
        }
        /* change height as you like */
        @media print {
            body.receipt {
                width: 50mm
            }
        }
        /* this line is needed for fixing Chrome's bug */
    </style>
    <title>Print Barcode</title>
</head>

<body onload="window.print()">
    <div class="col-12">
        <div class="text-center">
            <h6 class="mb-4">Print Copies: {{ $print_information['print_quantity'] }}</h6>
        </div>
        <hr>





        @for ($i = 1; $i <= $print_information['print_quantity']; $i++)

            <div class="mb-4" style="padding:13px; font-size:8;">
                <center>

                    @if ($print_information['outlet_title'] != null)
                        <p class="mb-0" style="font-size: 6">Outlet: {{ $print_information['outlet_title'] }}</p>
                       
                    @endif
                    @if ($print_information['product_title'] != null)
                        <p class="mb-0" style="font-size: 6">{{ $print_information['product_title'] }}</p>
                    @endif
                    {{-- '<img src="data:image/png,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"   /> --}}
                    {!! DNS1D::getBarcodeSVG($product->product_barcode, 'C128', 1, 40) !!}
                    {{-- <span style="letter-spacing: 4">{{ $product->product_barcode }}</span> --}}
                    @if ($print_information['product_price'] != null)
                        
                        <p class="mt-1" style="font-size: 6">Price: {{ $print_information['product_price'] }}</p>
                    @endif

                </center>
            </div>

        @endfor


    </div>
</body>

</html>