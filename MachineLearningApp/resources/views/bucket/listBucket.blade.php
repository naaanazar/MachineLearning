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

                <form class="create-datasource" method="post" action="bucket/create_bucket">
                    <br>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="nameBucket" placeholder="ml-" name="nameBucket">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <br>
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

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <table class="table table-bordered table-font text-center">
                        <tr class="active">
                            <td>Id</td>
                            <td>Name</td>
                            <td>Delete bucket</td>
                            <td>Delete all files</td>

                        </tr>

                        @foreach($results as $key => $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $value['Name'] }}</td>
                                <td><a class="btn btn-danger btn-sm btn-list"
                                       href="/bucket/delete/{{ $value['Name'] }}"
                                       id="delete-{{ $key }}"><span
                                                class="glyphicon glyphicon-trash"></span></a></td>
                                <td><a class="btn btn-danger btn-sm btn-list"
                                       href="bucket/delete_all/{{ $value['Name'] }}"><span class="glyphicon"></span>Delete
                                        all files in bucket</a></td>
                                {{--<td>--}}
                                {{--<a class="btn btn-default btn-sm"--}}
                                {{--href="https://s3.amazonaws.com/ml-datasets-test/{{ $value['Key'] }}"><span--}}
                                {{--class="glyphicon glyphicon-download"></span></a>--}}
                                {{--<a class="btn btn-danger btn-sm btn-list" href="/s3/delete/{{ $value['Key'] }}"><span--}}
                                {{--class="glyphicon glyphicon-trash"></span></a>--}}
                                {{--</td>--}}
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
    <br>
    <br>
    @stop