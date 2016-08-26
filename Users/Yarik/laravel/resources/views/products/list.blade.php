<!DOCTYPE html>
<html>
    <head>
        <title>All Products</title>
        <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!--<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">-->

    </head>
    <body>
        <div class="container">
            <div class="content">
                <ul>
                    @foreach($products as $product)
                        <li>
                            <a href='/product/{{$product->id}}'> {{$product->title}} </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </body>
</html>





