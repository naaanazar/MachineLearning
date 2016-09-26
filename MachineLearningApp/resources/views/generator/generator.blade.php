@extends('main')

@section('content')

<script type="text/javascript" src="{{ URL::to('js/generate-dataset.js') }}"></script>

<div class="container">    
    <div class="row generator-form col-xs-12">
        <h3 align='center'>Generate dataset</h3> 
        <div class="col-md-offset-4 col-md-4 col-xs-12 generator-input-container">
            <input class="form-control" id="rows-number" ondrop="return false" name="rows" placeholder="Records quantity" min="1">
            <div class='empty-msg'></div>
        </div>
        <div class="col-md-2 col-xs-4 generator-button-container">
            <a id="generate-btn" class="btn btn-info disabled" href="{{ URL::to('generate') }}">Generate</a>
        </div>
        <div class="spinner-warapper">
            <i class="fa fa-spinner fa-4x fa-spin" style="display: none;"></i>
        </div> 
    </div>
</div>
    
@endsection

