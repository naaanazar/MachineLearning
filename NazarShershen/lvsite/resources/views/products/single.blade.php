@extends('main')

@section('content')

<div class="col-md-8 col-md-offset-2">
    <h1>{{ $item->title }}</h1>
    <img src="{{ $item->img }}">
    <p>{{ $item->description }}</p>
</div>

<div class="col-md-8 col-md-offset-2">
        <a href="{{ URL::to('products/'.$item->id.'/edit') }}" class="btn btn-success">Edit product</a>
</div>

@endsection