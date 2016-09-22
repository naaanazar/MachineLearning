@extends('main')

@section('content')
    <script src="{{ URL::to('js/s3/tabS3.js') }}"></script>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 class="title"><img class="logo-s3" src="{{ URL::to('images/aws-s3.png') }}" alt="s3">Buckets</h2>

                <a class="btn btn-default" href="#modalCreateBucket" id="describeCreateBucketContent" data-toggle="modal" data-target="#modalCreateBucket">Create Bucket</a>

                <div class="modal fade modalCreateBucket" id="modalCreateBucket" role="dialog">

                    <div class="modal-dialog">

                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h2 align="center">Create Bucket</h2>

                <form class="create-datasource" method="post" action="s3/create_bucket">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <br>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="nameBucket" placeholder="ml-" name="nameBucket">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
                    </div>
                    </div>
                    </div>
                    </div>
                <br>
                <br>
                <br>
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
                            <div class="loader col-md-2 col-md-offset-5 hide" id="loader-s3-main">
                            <tr class="active table-header">
                                <td>Name</td>
                                <td>Size</td>
                                <td>Last modified</td>
                                <td>Action</td>

                            </tr>
                            <tr class="bg">
                                <td colspan="4" ><span class="back">...</span></td>
                            </tr>
                            @foreach($results as $key => $value)
                                <tr class="content bg">
                                    <td class="reference">{{ $value['Name'] }}</td>
                                    <td>0</td>
                                    <td>{{ $value['CreationDate'] }}</td>
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