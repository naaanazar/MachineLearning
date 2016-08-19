@extends('layout')
@section('script')
    <script>
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });

        $(document).ready(function() {
            $('.delete').on('click', function(e){
                e.preventDefault();
                $.post( $(e.target).attr('href'), function( data ) {
                    if(data.success) {
                        $(e.target).closest('li').fadeOut();
                    }
                });
            });
        });
    </script>
@stop
@section('content')
    @foreach($products as $product)
        <li class="list-group-item">
            <h3 class="text-center"><a href="/products/{{$product->id}}">{{$product->title}}</a></h3>
            <a class="delete" href="/products/delete/{{$product->id}}">{{ trans('main.delete') }}</a>
            <br>
            <img class="img-rounded img-responsive center-block" src="{{$product->description}}">
            <hr>
            <p>{{$product->img_url}}</p>
        </li>
        <br>
    @endforeach
    <div class="text-center">
        {{ $products->links() }}
    </div>
@stop
@section('footer')
    <div class="panel-footer text-center">Crowdin Space &copy; 2016</div>
@stop