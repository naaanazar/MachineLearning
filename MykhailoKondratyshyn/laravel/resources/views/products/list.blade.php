<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


    </script>

    <script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>


</head>
<body>

<div class="h1">All Products</div>

@foreach($products as $product)

    <p><a href="/products/{{$product->id}}">{{$product->title}}</a>

    <a href="/products/delete/{{$product->id}}">Delete</a></p>
@endforeach

</body>
</html>



