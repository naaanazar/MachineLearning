
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Document</title>
    <script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>
</head>
<body>

<h3>Add New </h3>

<form method="post" enctype="multipart/form-data" action="/products/save">

    <div class="form-group">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <textarea name="title" class="form-control"></textarea>
{{--@foreach($product as $produc)--}}
    {{--<p>{{$produc}}</p>--}}
    {{--@endforeach--}}

    </div>

    <div class="form-group">

        <button type="submit" class="btn-primary">Add Note</button>

    </div>


</form>


</body>
</html>



