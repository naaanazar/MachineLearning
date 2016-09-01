@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if (count($errors) > 0)
                    <div class="alert alert-danger upload-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><strong>Error!</strong> {{ (strpos($error, ', txt') != false) ? str_replace(", txt", "", $error) : $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif (session('status'))
                    <div class="alert alert-success upload-message">
                        <ul>
                            <li>{!! session('status') !!}</li>
                        </ul>
                    </div>
                @endif
                <h2 class="title-s3"><img class="logo-s3" src="{{ URL::to('images/aws-s3.png') }}" alt="s3"> List of files</h2>
                <form class="form form-upload" enctype="multipart/form-data" action="{{ action('S3Controller@upload') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="input-file" class="btn btn-primary btn-file" data-toggle="tooltip" data-placement="bottom" title="csv">
                            <span class="glyphicon glyphicon-upload"></span>&nbsp;Upload Dataset in CSV<input id="input-file" type="file" name="file">
                        </label>
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
                                <a class="btn btn-default btn-sm" href="https://s3.amazonaws.com/ml-datasets-test/{{ $value['Key'] }}"><span class="glyphicon glyphicon-download"></span></a>
                                <a class="btn btn-danger btn-sm" href="/s3/delete/{{ $value['Key'] }}"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    <div class="pagination-list">
                        <?php echo $results->render(); ?>
                    </div>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
@stop