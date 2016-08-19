@extends('main')

@section('content')

<div class="col-md-8 col-md-offset-2">
    <h1>{{ $item->title }}</h1>
    <img src="/{{ $item->img }}">
    <p>{{ $item->description }}</p>
</div>

@endsection