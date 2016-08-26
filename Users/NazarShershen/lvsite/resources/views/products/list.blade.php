@extends('main')

@section('content')

<div class="row">
    <div class="col-md-4">
        <a href="{{ URL::to('products/add') }}" class="btn btn-success">Add new product</a>
    </div>
    <div class="col-md-4">
        <div class="well">{{ trans_choice('main.total_products', $products->total(), ['count' => $products->total()] ) }}</div>
    </div>
</div>


@foreach ($products as $item)
<div class="row">
    <div class="col-md-12 product-item">
        <a href="{{ URL::to('/products/'.$item->id) }}">
            <h3>{{ $item->title }}</h3>            
        </a>
        <img width="" height="100" src="{{ $item->img }}"><br><br>
        
        @unless(empty($item->deleted_at))
            <script>
                $('div.product-item h3').css('color', 'grey');
            </script>
            <a href="{{ URL::to('products/restore/'.$item->id) }}" class="btn btn-info restore-button">{{ trans('main.restore') }}</a>
        @else
            <a href="{{ URL::to('products/delete/'.$item->id) }}" class="btn btn-danger delete-button">{{ trans('main.delete') }}</a>
        @endunless
            <a href="{{ URL::to('products/forcedelete/'.$item->id) }}" class="btn btn-danger permanently-delete-button">{{ trans('main.forceDelete') }}</a>
    </div>
</div>
@endforeach
<div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
        {{ $products->links() }}
    </div>
</div>

@endsection