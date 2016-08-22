@extends('main')

@section('content')

<h1>Edit</h1>

<div class="col-md-6 col-md-offset-3">
    <form role="form" method="post" action="/products/{{ $item->id }}" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        {{ CSRF_field() }}

        <div class="form-group">
            @if ($errors->has('title'))
                <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ $errors->first('title') }}
                </div>
            @endif
            <label for="title">Title</label></br>
            <input class="form-control" id="title" type="text" name="title" value="{{ $item->title }}">
        </div>
        <div class="form-group">
            @if ($errors->has('description'))
                <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ $errors->first('description') }}
                </div>
            @endif
            <label for="description">Description</label></br>
            <textarea class="form-control" id="description" name="description">{{ $item->description }}</textarea>
        </div>
        <div class="form-group">
            @if ($errors->has('img'))
                <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ $errors->first('img') }}
                </div>
            @endif
            <label for="image">Image</label></br>
            <input class="form-control" id="image" name="img" type="file"><br>
            <img height="150px" src="{{ $item->img }}">
        </div>
        <button class="btn btn-primary" type="submit">Update</button>
    </form>

    @if($errors)
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
</div>


@endsection