@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>{{$product->title}}</h1>
            <p align="center"><img src="{{$product->img_url}}"></p>
            <p align="center">Price: {{$product->description}}</p>


            <a class="btn btn-primary" href="/products/{{$product->id}}/edit">Edit</a>

            <ul class="list-group">
                <h1>Comments</h1>

                @foreach($product->notes as $note)

                    <li class="list-group-item">{{$note->body}}</li>
                @endforeach

            </ul>


            <h3>Add New </h3>

            <form method="post" enctype="multipart/form-data" action="/products/{{$product->id}}/notes">

                <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <textarea name="body" class="form-control"></textarea>


                </div>

                <div class="form-group">

                    <button type="submit" class="btn btn-primary">Add Note</button>

                </div>


            </form>

        </div>
    </div>
@endsection