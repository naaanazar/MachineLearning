<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>

<h1>{{$product->title}}</h1>


<ul class="list-group">

    @foreach($product->notes as $note)

        <li class="list-group-item">{{$note->body}}</li>
    @endforeach


</ul>


</body>
</html>



