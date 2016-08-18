@extends('layout')


@section('content')
@foreach($products as $product)

    <p><img src="{{$product->img_url}}"></p>

    <p><a href="/products/{{$product->id}}">{{$product->title}}</a>
    <div class="col-md-2">
        <p align="center"><a class="btn btn-danger" href="/products/{{$product->id}}/delete">Delete</a></p>
    </div>
    <br>
    <br>
    <br>
    </p>
@endforeach

@endsection