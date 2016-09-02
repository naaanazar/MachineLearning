@extends('main')

@section('content')

<script type="text/javascript" src="{{ URL::to('js/generate-dataset.js') }}"></script>

<div class="container">    
    <div class="row generator-form">
        <div class="col-md-12">
            <h3 align='center'>Generate dataset</h3>
            <div class="col-md-6 col-md-offset-3">
                <div class="alert alert-danger fade in errors-alert" style="display: none;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                <input style="display: inline-block; width: 80%; margin-top: 20px;" class="form-control" id="rows-number" type="number" name="rows" placeholder="Records number">
                <a id="generate-btn" class="btn btn-info" href="{{ URL::to('generate') }}">Generate</a>
            </div>
        </div>
        <div class="col-md-12" style="text-align: center; padding-top: 50px;" >
            <i class="fa fa-spinner fa-4x fa-spin" style="display: none;"></i>
        </div>
        <div class="col-md-8 col-md-offset-2 messages"></div>
    </div>    
</div>
    
@endsection

