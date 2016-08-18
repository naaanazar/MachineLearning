@extends('template.master')

@section('content')


<div class="container">
    <div class="panel panel-primary">
        <div class="panel-body">
            <img src={{ $product->img_url }}  class="img-thumbnail">
            <p>{{ $product->title }}</p>
        </div>
        <div class="panel-footer">{{ $product->description }}</div>
    </div>
    <a class="btn btn-default" href="http://laravel.loc/products" role="button">back</a>
</div>

@endsection

