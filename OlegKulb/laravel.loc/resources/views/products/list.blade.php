@extends('template.master')


@section('content')

@foreach ($products as $user)

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                @if( $user->deleted_at )
                <p class="bg-danger text-center">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    deleted
                </p>
                @endif
                <div class="panel-body">
                    <a href="http://laravel.loc/showProduct/{{$user->id}}">
                        <img src={{ $user->img_url }}  class="img-circle">
                        <p>{{ $user->title }}</p>
                        <a/>
                </div>
                <div class="panel-footer">{{ $user->description }}</div>
            </div>
        </div>
        <div class="col-md-2">
            <a href="http://laravel.loc/products/delete/{{$user->id}}" class=" btn btn-danger delete">
                {{ trans('main.delete') }}
            <a/>
            
            <a href="http://laravel.loc/products/edit/{{$user->id}}">
                <button type="button" class="btn btn-primary">Edit</button>
            <a/>
        </div>
    </div>
</div>



@endforeach

@endsection





