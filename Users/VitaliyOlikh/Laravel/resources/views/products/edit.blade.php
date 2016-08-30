@extends('layout')
@section('content')
    <h1>Edit Product</h1>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form" method="post" action="{{ URL::to('update') }}/{{$products->id}}" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label" for="title">Title: </label>
            <input class="form-control" type="text" name="title" id="title" required value="{{ $products->title }}">
        </div>
        <div class="form-group">
            <label class="control-label" for="file">Select image for upload:</label>
            <input type="file" name="file" id="file" required value="{{ $products->description }}">
        </div>
        <div class="form-group">
            <label class="control-label" for="description">Description: </label>
            <textarea class="form-control" name="description" id="description" required>{{ $products->img_url }}</textarea>
        </div>
        <input class="btn btn-primary" type="submit" value="Edit" name="submit">
        <input type="hidden" value="{{ csrf_token() }}" name="_token">
    </form>
@stop
@section('footer')
    <div class="footer navbar-fixed-bottom">
        <div class="panel-footer text-center">Crowdin Space &copy; 2016</div>
    </div>
@stop