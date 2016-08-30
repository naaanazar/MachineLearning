@extends('main')

@section('content')

<div class="container">    
    <div class="row">
        <div class="col-md-12">
            <h3 align='center'>Generate dataset</h3>
            <form style="padding: 10px 0;" method="post" action="" class="form-inline">
                {{ CSRF_field() }}
                <input class="form-control" type="number" name="rows" placeholder="Records number">
                <button class="btn btn-info">Generate</button>
            </form>                       
        </div>
        @if($errors)
            <div class="col-md-12">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>    
    @unless(empty($stats))
        <hr>
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li>Records number: {{ $stats['recordsNumber'] }}</li>
                    <li>Purchase number: {{ $stats['purchaseNumber'] }}</li>
                    <li>Purchase percentage: {{ $stats['purchasePercentage'] }}%</li>
                    <li>Dataset: <a href="{{ URL::to($stats['path']) }}">{{ basename($stats['path']) }}</a></li>
                </ul>
            </div>
        </div>
    @endunless
</div>
    
@endsection

