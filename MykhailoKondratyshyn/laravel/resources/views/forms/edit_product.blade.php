@extends('layout')

@section('content')

    <form method="post" enctype="multipart/form-data" action="/products/save_edit">
{{ method_field('PATCH') }}
        <div class="form-group">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <p>Title</p>
            <textarea name="title" class="form-control"></textarea>
            <p>Description</p>
            <textarea name="description" class="form-control"></textarea>
            <p class="help-block">Add img for product</p>
            <input type="file" id="exampleInputFile" name="img_url" value="{{ old('img') }}">
            {{--@foreach($product as $produc)--}}
            {{--<p>{{$produc}}</p>--}}
            {{--@endforeach--}}

        </div>

        <div class="form-group">

            <button type="submit" class="btn btn-primary">Update</button>

        </div>


    </form>

@endsection