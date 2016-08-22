@extends('layout')
@section('content')
    <ul>
        <li class="list-group-item">
            <h3 class="text-center">{{ $products->title }}</h3>
            <img class="img-rounded img-responsive center-block" src="../{{ $products->description }}">
            <p>{{ $products->img_url }}</p>
        </li>
    </ul>
@stop
@section('footer')
    <div class="panel-footer text-center">Crowdin Space &copy; 2016</div>
@stop