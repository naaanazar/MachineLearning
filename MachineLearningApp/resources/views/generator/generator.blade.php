@extends('main')

@section('content')

<script type="text/javascript" src="{{ URL::to('js/generate-dataset.js') }}"></script>
<script type="text/javascript">var MAX_ROWS_COUNT = {{ $maxRowsCount }}</script>

<div class="container">    
    <div class="row generator-form col-xs-6 col-xs-offset-3">
        <h3 align='center'>Generate dataset</h3> 

        <div class="input-group generator-input-container">
            <input id="rows-number" name="rows" class="form-control" min="1" max="{{ $maxRowsCount }}" type="number" placeholder="Number of rows (max: {{ $maxRowsCount }})">
            <span class="input-group-btn">
                <button id="generate-btn" class="btn btn-primary disabled" type="button" disabled>Generate</button>
            </span>
        </div>
        <span class="empty-msg error"></span>
        <div class="spinner-warapper">
            <i class="fa fa-spinner fa-4x fa-spin" style="display: none;"></i>
        </div>
    </div>
</div>
    
@endsection
