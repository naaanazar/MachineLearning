@extends('layout')


@section('content')
    <div>
        <a class="btn btn-primary" href="/products/add_new">Add New</a>
    </div>
    @foreach($products as $product)
        @if($product->deleted_at)

            <div align="left" class="product" style="background-color:#b4ebff">
                <p><img src="{{$product->img_url}}"></p>
                <a href="/products/{{$product->id}}">{{$product->title}}</a>
                <div class="col-md-2">
                    <p align="center"><a class="btn btn-primary" href="/products/{{$product->id}}/restore">Restore</a>
                    </p>
                </div>
            </div>

        @else


            <div class="product">
                <p><img src="{{$product->img_url}}"></p>
                <a href="/products/{{$product->id}}">{{$product->title}}</a>
                <div class="col-md-2">
                    <p align="center"><a class="btn btn-danger" href="/products/{{$product->id}}/delete">Delete</a></p>
                </div>
            </div>
            <br>
            <br>
            <br>
        @endif
    @endforeach
    <?php echo $products->links(); ?>



@endsection