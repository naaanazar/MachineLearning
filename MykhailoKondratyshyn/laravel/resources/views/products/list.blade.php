<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Document</title>


</head>
<body>

<div class="h1">All Products</div>

@foreach($products as $product)

    <p><a href="/products/{{$product->id}}">{{$product->title}}</a></p>
@endforeach

</body>
</html>



