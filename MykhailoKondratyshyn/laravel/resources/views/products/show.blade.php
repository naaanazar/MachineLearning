<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<div class="row">
    <div class="col-md-6 col-md-offset-3"
    <h1>{{$product->title}}</h1>


    <ul class="list-group">

        @foreach($product->notes as $note)

            <li class="list-group-item">{{$note->body}}</li>
        @endforeach


    </ul>


    <h3>Add New </h3>

    <form method="post" enctype="multipart/form-data" action="/products/{{$product->id}}/notes">

        <div class="form-group">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <textarea name="body" class="form-control"></textarea>


        </div>

        <div class="form-group">

            <button type="submit" class="btn btn-primary">Add Note</button>

        </div>


    </form>
</div>
</div>

</body>
</html>



