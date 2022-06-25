<!DOCTYPE html>
<html>

<head>
    <title>Laravel 8 Autocomplete Search using Bootstrap Typeahead JS - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <style>
        .typeahead+.dropdown-menu {
            width: 600px;
        }

        .typeahead li {
            padding: 10px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1>Autocomplete Search</h1>
        <input class="typeahead form-control" type="text">
    </div>

    <script type="text/javascript">
        var path = "{{ route('autocomplete') }}";

        $('input.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    // console.log(data);
                    return process(data);
                });
            },

            highlighter: function(item, data) {

                if (data.image == 'placeholder.jpg') {
                    imagefolder = "{{asset('storage/')}}";
                } else {
                    imagefolder = "{{asset('storage/products/')}}";
                }


                var parts = item.split('#'),
                    html = '<ul class="list-unstyled">'
                html += ' <li class="media">';
              
                html += '<img class="mr-3" style="width:40px;" src="' + imagefolder + "/" + data.image + '" alt="' + data.image + '">';
            
                html += '<div class="media-body">';
                html += '<div class="text-dark-75 font-weight-bolder font-size-lg mb-0">' + data.name + '</div>';
                html += '<span class="text-muted">30 in stock</span>'
                html += '</div>';
                html += '<div>';
                html += '<span class="text-dark font-weight-bold">$300</span';
                html += '</div>';
                html += ' </li>';
                html += '</ul>';

                return html;
            }
        });
    </script>



</body>

</html>