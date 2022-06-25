<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>


    <div class="container text-center">
        <form action="{{ route('barcode.print') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <h3>{{ $product->product_title }} ({{ $product->product_barcode }})</h3>
            <br><br>

            <div class="form-group">
                {{-- <label for="">Quantity</label> --}}
                <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}"
                    placeholder="Print Quantity" required>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <input type="checkbox" id="product_title" value="{{ $product->product_title }}">
                        <label for="">Product Title</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <input type="checkbox" id="product_price" value="{{ $product->retail_price }}">
                        <label for="">Product Price</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <input type="checkbox" id="outlet_title" value="{{ $product->outlet_title }}">
                        <label for="">Outlet Title</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                        <path
                            d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                    </svg> Print</button>
            </div>

            <input type="hidden" name="product_price" id="price" value="">
            <input type="hidden" name="product_title" id="product" value="">
            <input type="hidden" name="outlet_title" id="outlet" value="">

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

<script>
    document.getElementById('product_price').addEventListener('change', function () {
        if(this.checked){
            document.getElementById('price').value = this.value;
        }
     });
     document.getElementById('product_title').addEventListener('change', function () {
        if(this.checked){
            document.getElementById('product').value = this.value;
        }
     });
     document.getElementById('outlet_title').addEventListener('change', function () {
        if(this.checked){
            document.getElementById('outlet').value = this.value;
        }
     });
</script>
</body>

</html>