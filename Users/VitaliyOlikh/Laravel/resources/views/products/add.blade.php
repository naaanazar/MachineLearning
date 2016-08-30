@extends('layout')
@section('content')
    <h1>Add Product</h1>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form" method="post" action="{{ URL::to('upload') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label" for="title">Title: </label>
            <input class="form-control" type="text" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label class="control-label" for="file">Select image for upload:</label>
            <input type="file" name="file" id="file" required>
        </div>
        <div class="form-group">
            <label class="control-label" for="description">Description: </label>
            <textarea class="form-control" name="description" id="description" required></textarea>
        </div>
        <input class="btn btn-primary" type="submit" value="Upload" name="submit">
        <input type="hidden" value="{{ csrf_token() }}" name="_token">
    </form>
@stop
@section('footer')
    <div class="footer navbar-fixed-bottom">
        <div class="panel-footer text-center">Crowdin Space &copy; 2016</div>
    </div>
@stop