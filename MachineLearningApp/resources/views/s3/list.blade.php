@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3 class="title"><img class="logo-s3" src="{{ URL::to('images/aws-s3.png') }}" alt="s3">List of files</h3>
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