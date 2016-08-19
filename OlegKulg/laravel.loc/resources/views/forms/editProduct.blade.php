@extends('template.master')

@section('content')

<br />
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-3 text-center">
            <h1>Edit product</h1>
            
            <img src={{ $product->img_url }}  class="img-thumbnail ">
            <form method="post" enctype="multipart/form-data" action="/products/saveEdit">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">title</label>
                    <div class="col-sm-10">
                        @if($errors->first('title'))
                        <div class="alert alert-danger" role="alert">{{  $errors->first('title')  }}</div>
                        @endif
                        <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{ $product->title }}">
                    </div>
                </div>

                <br /><br /><br />
                
                <div class="form-group">
                    <label for="inputDescription" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        @if($errors->first('description'))
                        <div class="alert alert-danger" role="alert">{{  $errors->first('description')  }}</div>
                        @endif
                        <textarea class="form-control" name="description" rows="3" >{{ $product->description }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    @if($errors->first('img'))
                    <div class="alert alert-danger" role="alert">{{  $errors->first('img')  }}</div>
                    @endif
                    <input type="file" id="exampleInputFile" name="img">
                    <p class="help-block text-left">Add img for product</p>
                </div>

                <input type="submit" class="btn btn-default">
            </form>

            @if ( isset($readiness) )
            <div class="alert alert-success" role="alert">{{  $readiness  }}</div>
            @endif
        </div>
    </div>
</div>

@endsection
