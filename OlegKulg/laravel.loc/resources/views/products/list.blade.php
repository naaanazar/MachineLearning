@extends('template.master')

@section('content')

{{ trans_choice('main.total_items', $products->total(), ['count' => $products->total()]) }}

{{ $products->links() }}

<div class="container">
    @foreach ($products as $user)
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                @if( $user->deleted_at )
                    <p class="bg-danger text-center">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        deleted
                    </p>
                @endif
                <div class="panel-body">
                    <a href="http://laravel.loc/showProduct/{{$user->id}}">
                        <img src={{ $user->img_url }}  class="img-circle">
                        <p>{{ $user->title }}</p>
                    <a/>
                </div>
                <div class="panel-footer">{{ $user->description }}</div>
            </div>
        </div>
        <div class="col-md-3">
            @if( $user->deleted_at )
                <a href="http://laravel.loc/products/forceDelete/{{$user->id}}" id='ForceDelete' class=" btn btn-danger delete">
                    {{ trans('main.ForceDelete') }}
                <a/>
                <a href="http://laravel.loc/products/restore/{{$user->id}}" id='restore' class=" btn btn-success restore">
                    {{ trans('main.restore') }}
                <a/>
            @else
                <a href="http://laravel.loc/products/delete/{{$user->id}}" id="delete" class=" btn btn-warning delete">
                    {{ trans('main.delete') }}
                <a/>
                <a href="http://laravel.loc/products/edit/{{$user->id}}">
                    <button type="button" class="btn btn-primary">Edit</button>
                <a/>
            @endif

        </div>
    </div>
    @endforeach

    <div class="row clearfix">
        <div class="col-md-4 col-md-offset-4">
        </div>
    </div>

</div>

@endsection

@section('script')
<script>
    
</script>
@endsection





