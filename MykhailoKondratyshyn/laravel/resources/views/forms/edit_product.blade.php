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

    <form method="post" enctype="multipart/form-data" action="/products/save_edit">
        {{ method_field('PATCH') }}
        <div class="form-group">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <p>Title</p>
            <textarea name="title" class="form-control"></textarea>
            <p>Description</p>
            <textarea name="description" class="form-control"></textarea>
            <p class="help-block">Add img for product</p>
            <input type="file" id="exampleInputFile" name="img_url">


        </div>

        <div class="form-group">

            <button type="submit" class="btn btn-primary">Update</button>

        </div>


    </form>

@endsection