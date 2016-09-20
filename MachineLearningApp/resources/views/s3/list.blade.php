@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 class="title"><img class="logo-s3" src="{{ URL::to('images/aws-s3.png') }}" alt="s3">Buckets
                </h2>

                <button class="btn btn-default btn-create-datasource">Create Bucket</button>
                <br>
                <br>

                <form class="create-datasource" method="post" action="s3/create_bucket">
                    <br>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="nameBucket" placeholder="ml-" name="nameBucket">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <form class="form form-upload" enctype="multipart/form-data" action="{{ action('S3Controller@doUpload') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="input-file" class="btn btn-primary btn-file" data-toggle="tooltip" data-placement="bottom" title="csv">
                            <span class="glyphicon glyphicon-upload"></span>&nbsp;Upload Dataset in CSV<input id="input-file" type="file" name="file">
                        </label>
                        <span class="preload-s3"><i class="s3-preload fa fa-spinner fa-spin" style="font-size: 24px"></i></span>
                    </div>
                </form>
            </div>

            <br>

            <div class="form-group">

                @if (count($errors) > 0)
                    <br>
                    <br>
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    <strong>Error!</strong> {{ (strpos($error, ', txt') != false) ? str_replace(", txt", "", $error) : $error }}
                                </li>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $.jGrowl("Error!", {sticky: true, theme: 'jGrowl-status-error'});
                                    });
                                </script>
                            @endforeach
                        </ul>
                    </div>
                @elseif (session('status'))
                    <br>
                    <br>
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! session('status') !!}</li>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $.jGrowl("Success!", {sticky: true, theme: 'jGrowl-status-success'});
                                });
                            </script>
                        </ul>
                    </div>
                @endif
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <table class="table table-bordered table-font text-center" id="myTable">
                            <div class="loader col-md-2 col-md-offset-5" id="loader-s3-main">
                            <tr class="active table-header hide">
                                <td>Name</td>
                                <td>Size</td>
                                <td>Last modified</td>
                                <td>Action</td>

                            </tr>
                            <tr class="bg hide">
                                <td colspan="4" ><span class="back">...</span></td>
                            </tr>
                            @foreach($results as $key => $value)
                                <tr class="content bg hide">
                                    <td class="reference">{{ $value['Name'] }}</td>
                                    <td>0</td>
                                    <td></div>{{ $value['CreationDate'] }}</td>
                                    <td>
                                        <a class="btn btn-danger btn-sm btn-list"
                                           href="/s3/delete/{{ $value['Name'] }}"
                                           id="delete-{{ $key }}"><span
                                                    class="glyphicon glyphicon-trash"></span></a>
                                        <a class="btn btn-danger btn-sm btn-list"
                                           href="s3/delete_all/{{ $value['Name'] }}"><span class="glyphicon"></span>Delete
                                            all files</a>
                                    </td>
                                </tr>
                            @endforeach
                            <div class="pagination-list">
                                <!--                        --><?php //echo $results->render(); ?>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    @stop