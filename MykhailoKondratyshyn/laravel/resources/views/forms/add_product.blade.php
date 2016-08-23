@extends('layout')

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" enctype="multipart/form-data" action="/products/save">

        <div class="form-group">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <p>Title</p>
            <textarea name="title" class="form-control">Title</textarea>
            <p>Description</p>
            <textarea name="description" class="form-control">Description</textarea>
            <p class="help-block">Add img for product</p>
            <input class="form-control" type="file" id="img_url" name="img_url">


        </div>

        <div class="form-group">

            <button type="submit" class="btn btn-primary">Add Note</button>

        </div>


    </form>

@endsection