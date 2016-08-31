@extends('main')

@section('content')
<!--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.1/jquery.jgrowl.min.css" />  online library(default css)-->
<link rel="stylesheet" type="text/css" href="/css/jquery.jgrowl/jquery.jgrowl.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.1/jquery.jgrowl.min.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 class="title"><img class="logo-s3" src="{{ URL::to('images/aws-s3.png') }}" alt="s3">List of files</h2>
                <form class="form form-upload" enctype="multipart/form-data" action="upload" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="input-file" class="btn btn-primary btn-file" data-toggle="tooltip" data-placement="bottom" title="csv">
                            <span class="glyphicon glyphicon-upload"></span>&nbsp;Upload Dataset in CSV<input id="input-file" type="file" name="file">
                                </label>
                        @if (count($errors) > 0)
                            <br>
                            <br>
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li><strong>Error!</strong> {{ (strpos($error, ', txt') != false) ? str_replace(", txt", "", $error) : $error }}</li>
                                                <div class="jGrowl">
                                                    <script src="/js/pop-up-message-error.js"></script>
                                                </div>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif (session('status'))
                            <br>
                            <br>
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! session('status') !!}</li>
                                        <div class="jGrowl">
                                            <script src="/js/pop-up-message-succes.js"></script>
                                        </div>
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
                                <a class="btn btn-default btn-sm" href="https://s3.amazonaws.com/ml-datasets-test/{{ $value['Key'] }}"><span class="glyphicon glyphicon-download"></span></a>
                                <a class="btn btn-danger btn-sm btn-list" href="/s3/delete/{{ $value['Key'] }}"><span class="glyphicon glyphicon-trash"></span></a>
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