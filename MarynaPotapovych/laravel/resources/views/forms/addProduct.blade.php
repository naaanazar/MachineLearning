@extends('main')

@section('content')

<style>
    #description {height: 200px;}

</style>

<div class="col-md-6 col-md-offset-3">
    <form role="form" method="post" action="save" enctype="multipart/form-data">
        {{ CSRF_field() }}

        <div class="form-group">
            <label for="title">Title</label></br>
            <input class="form-control" id="title" type="text" name="title"></br></br>
        </div>
        <div class="form-group">
            <label for="description">Description</label></br>
            <textarea class="form-control" id="description" name="description"></textarea></br></br>
        </div>
        <div class="form-group">
            <label for="image">Image</label></br>
            <input class="form-control" id="image" name="img" type="file"></br></br>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
</form>
    
    @if($errors)
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
</div>