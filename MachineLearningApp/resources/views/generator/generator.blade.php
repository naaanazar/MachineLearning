@extends('main')

@section('content')

<script type="text/javascript" src="{{ URL::to('js/generate-dataset.js') }}"></script>

<div class="container">    
    <div class="row generator-form col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div>
            <h3 align='center'>Generate dataset</h3>
            <div>    
                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-10" >          
                <input style="display: inline-block; margin-top: 20px;" class="form-control" id="rows-number" ondrop="return false" name="rows" placeholder="Records quantity" min="1">
                </div>
                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2" >
                    <a id="generate-btn" class="btn btn-info disabled"; style="margin-top: 20px; margin-left:-25px;"; href="{{ URL::to('generate') }}">Generate</a>
                    <div class='empty-msg'>    
                    </div>
                </div>
            </div>
            <div style="text-align: center; padding-top: 50px;">
                <i class="fa fa-spinner fa-4x fa-spin" style="display: none;"></i>
            </div>
            <div class="messages">
            </div>
        </div>    
    </div>
</div>
    
@endsection

