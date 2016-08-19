@extends('layout')


@section('content')
@foreach($products as $product)
    <div class="product">
        <p><img src="{{$product->img_url}}"></p>
        <a href="/products/{{$product->id}}">{{$product->title}}</a>
        <div class="col-md-2">
            <p align="center"><a class="btn btn-danger" href="/products/{{$product->id}}/delete">Delete</a></p>
        </div>
    </div>
    <br>
    <br>
    <br>
@endforeach
<?php echo $products->links(); ?>



@endsection