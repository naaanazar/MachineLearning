<!DOCTYPE html>
<html>
    <head>
        <title>Product</title>
        <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!--<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">-->

    </head>
    <body>
        <div class="container">
            <div class="content">
                <form method="get" id="show_product">
                    <p>Name: {{$product->title}} </p>
                    <p>Description: {{$product->description}}</p>
                    <img src = '{{$product->img}}' />
                    <p>Price: {{$product->price}} grn. </p>
                    <a href='/product/{{$product->id}}/edit'> <button type="button" form="show_product" value="Edit">Edit</button></a>
                    <a href='/product/{{$product->id}}/delete'><button type="button" form="show_product" value="Delete">Delete</button></a>
                </form>
            </div>
        </div>
    </body>
</html>





