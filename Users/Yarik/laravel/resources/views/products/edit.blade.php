<!DOCTYPE html>
<html>
    <head>
        <title>Product</title>
        <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<!--        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">-->

    </head>
    <body>
        <div class="container">
            <div class="content">
                <form method="get" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <!--<input type="hidden name="title" value="{{ $product->title }}">-->
                <textarea name="title"></textarea>
                </form>>
            </div>
        </div>
    </body>
</html>





