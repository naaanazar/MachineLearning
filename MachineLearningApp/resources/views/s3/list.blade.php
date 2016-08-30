@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 class="title"><img class="logo-s3" src="{{ URL::to('images/aws-s3.png') }}" alt="s3">List of files</h2>
                <form class="form form-upload" enctype="multipart/form-data" action="/upload" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="input-file" class="btn btn-primary btn-file" data-toggle="tooltip" data-placement="bottom" title="csv">
                            <span class="glyphicon glyphicon-upload"></span>&nbsp;Upload Dataset (csv)<input id="input-file" type="file" name="file">
                        </label>
                        @if (count($errors) > 0)
                            <br>
                            <br>
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li><strong>Error!</strong> {{ (strpos($error, ', txt') != false) ? str_replace(", txt", "", $error) : $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif (session('status'))
                            <br>
                            <br>
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! session('status') !!}</li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </form>
                <table class="table table-bordered table-font text-center">
                    <tr class="active">
                        <td>Target</td>
                        <td>Name</td>
                        <td>Size</td>
                        <td>Last modified</td>
                        <td>&nbsp;</td>
                    </tr>
                    @foreach($results as $key => $value)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $value['Key'] }}</td>
                            <td>{{ $value['Size'] }}</td>
                            <td>{{ $value['LastModified'] }}</td>
                            <td>
                                <a class="btn btn-danger btn-sm" href="/delete/{{ $value['Key'] }}"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop