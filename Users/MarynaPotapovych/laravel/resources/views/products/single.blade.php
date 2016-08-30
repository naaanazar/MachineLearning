
<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

<script   src="https://code.jquery.com/jquery-3.1.0.min.js" 
          integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" 
crossorigin="anonymous"></script>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ URL::to('products/'.$item->id.'/edit') }}" class="btn btn-info">Edit product</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h1>{{ $item->title }}</h1>
            <img src="{{ $item->img }}">
            <p>{{ $item->description }}</p>
        </div>
    </div>
</div>