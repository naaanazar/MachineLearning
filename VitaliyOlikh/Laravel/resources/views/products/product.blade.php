@extends('layout')
@section('content')
    <ul>
        <li class="list-group-item">
            <h3 class="text-center">{{$oneProduct[0]}}</h3>
            <img class="img-rounded img-responsive center-block" src="{{$oneProduct[1]}}">
            <p>{{$oneProduct[2]}}</p>
        </li>
    </ul>
@stop