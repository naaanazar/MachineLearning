@extends('main')

@section('content')
    <script src="{{ URL::to('js/s3/tabS3.js') }}"></script>
    <link href="css/hover.css" rel="stylesheet" media="all"> 
    <div class="container"> 
        <div class="row">
            <h2 class="title title-s3"><img class="logo-s3" src="{{ URL::to('images/aws-s3.png') }}" alt="s3"> Buckets
                <a class="btn-sm btn-success btn-create-bucket hvr-sweep-to-right" href="#modalCreateBucket" id="describeCreateBucketContent" data-toggle="modal" data-target="#modalCreateBucket"> + Add bucket</a></h2>
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
                                    <input type="text" class="form-control" id="nameBucket" placeholder="ml-" name="nameBucket" min="7">
                                </div>
                                <button type="submit" class="btn-bucket btn btn-primary" disabled>Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
        </div>
        <br>
        <div class="form-group">
            @if (count($errors) > 0)
                <br>
                <br>
                    <ul>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $.jGrowl("Error!", {sticky: true, theme: 'jGrowl-status-error'});
                            });
                        </script>
                    </ul>
            @elseif (session('status'))
                <br>
                <br>
                <ul>
                    <li>{!! session('status') !!}</li>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $.jGrowl("Success!", {sticky: true, theme: 'jGrowl-status-success'});
                        });
                    </script>
                </ul>
            @endif
        </div>

        <div class="container container-s3">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <table class="table table-bordered table-font text-left table-s3" id="myTable">
                        <div class="loader col-md-2 col-md-offset-5 hide" id="loader-s3-main">
                            <tr class="active ">
                                <td>Name</td>
                                <td>Size</td>
                                <td>Last modified</td>
                                <td>Action</td>
                            </tr>
                            <tr class="bg back">
                                <td colspan="4" ><span class="back-s3">...</span></td>
                            </tr>

                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    @stop