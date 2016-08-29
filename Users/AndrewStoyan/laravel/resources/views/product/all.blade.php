@extends('layouts.main')

@section('content')
	@foreach ($content as $product)
		<div class="col-xs-4 col-md-4">
			<h3 class="text-center">{{ $product->title }}</h3>
			<hr>
				<div class="text-center">
					<img src="{{ $product->picture }}">
					<hr>
				</div>
			<p class="text-justify">{{ $product->description }}</p>
		</div>
	@endforeach
@endsection