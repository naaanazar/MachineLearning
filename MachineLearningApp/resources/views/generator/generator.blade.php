@extends('main')

@section('content')

<script type="text/javascript" src="{{ URL::to('js/generate-dataset.js') }}"></script>

<div class="container">    
    <div class="row generator-form">
        <div class="col-md-12">
            <h3 align='center'>Generate dataset</h3>
            <input style="display: inline-block; width: 30%;" class="form-control" id="rows-number" type="number" name="rows" placeholder="Records number">
                <a id="generate-btn" class="btn btn-info" href="{{ URL::to('generate') }}">Generate</a>
        </div>
        <div class="col-md-12" style="text-align: center; padding-top: 50px;" >
            <i class="fa fa-spinner fa-4x fa-spin" style="display: none;"></i>
        </div>
        <div class="col-md-12 messages"></div>
    </div>    
</div>
    
@endsection

