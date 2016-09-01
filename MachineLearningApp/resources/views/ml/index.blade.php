@extends('main')

@section('content')

<div class="container">
    <div class="col-md-6">
        <button class="btn btn-default btn-create-datasource">Create Datasource</button>

        <form class="create-datasource" method="post" action="{{ action('MLController@createDataSourceFromS3') }}">
            <br>
            {{ csrf_field() }}
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>


    <div class="col-md-12">
        <h2 class="title"><img class="logo-s3" src="{{ URL::to('images/aws-ML.png') }}" alt="s3">List ML data</h2>
        <pre>
        {{ print_r($result) }}
    </div>
</div>

@stop
