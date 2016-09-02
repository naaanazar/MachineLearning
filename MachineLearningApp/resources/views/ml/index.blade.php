@extends('main')

@section('content')

<div class="container">
    <div class="col-md-6">
        <h2 class="title"><img class="logo-s3" src="{{ URL::to('images/aws-ML.png') }}" alt="ml">Machine Learning</h2>
    </div>
     
    <div class="col-md-12">
        <div class="col-md-8">
            <ul class="nav nav nav-pills nav-justified">
              <li class="active"><a data-toggle="tab" href="#describeDataSources">Data Source</a></li>
              <li><a data-toggle="tab" href="#describeMLModels">ML Models</a></li>
              <li><a data-toggle="tab" href="#describeEvaluations">Evaluations</a></li>
              <li><a data-toggle="tab" href="#describeBatchPredictions">Batch Predictions</a></li>
            </ul>
        </div>

        <div class="tab-content">           
            <div id="describeDataSources" class="tab-pane fade in active">
                <div class="col-md-4">
                    <button class="btn btn-primary btn-create-datasource pull-right">Create Datasource</button>
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
                <table class="table table-bordered table-font text-center">
                    <tr class="active">
                        <td>DataSourceId</td>
                        <td>Name</td>
                        <td>Status</td>
                        <td>DataLocationS3</td>
                        <td>Last Updated</td>
                        <td>&nbsp;</td>
                    </tr>
                @foreach($result['describeDataSources'] as $key => $value)
                    <tr>
                        <td>{{ $value['DataSourceId'] }}</td>
                        <td>{{ $value['Name'] }}</td>
                        <td>{{ $value['Status'] }}</td>
                        <td>{{ $value['DataLocationS3'] }}</td>
                        <td>{{ $value['LastUpdatedAt'] }}</td>
                        <td>
                            <a class="btn btn-info btn-sm btn-list" href="/ml/getdatasource/{{ $value['DataSourceId'] }}"><span class="glyphicon glyphicon-info-sign"></span></a>
                            <a class="btn btn-danger btn-sm btn-list" href="/ml/delete/{{ $value['DataSourceId'] }}"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
            <div id="describeMLModels" class="tab-pane fade">
                <div class="col-md-4">
                    <button class="btn btn-primary btn-create-mlmodel pull-right">Create ML Mode</button>
                    <form class="create-mlmodel" method="post" action="{{ action('MLController@createDataSourceFromS3') }}">
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
                <table class="table table-bordered table-font text-center">
                    <tr class="active">
                         <td>MLModelId</td>
                        <td>Name</td>
                        <td>Status</td>
                        <td>TrainingDataSourceId</td>
                        <td>MLModelType</td>
                        <td>Last Updated</td>
                        <td>&nbsp;</td>
                    </tr>
                    @foreach($result['describeMLModels'] as $key => $value)
                    <tr>
                        <td>{{ $value['MLModelId'] }}</td>
                        <td>{{ $value['Name'] }}</td>
                        <td>{{ $value['Status'] }}</td>
                        <td>{{ $value['TrainingDataSourceId'] }}</td>
                        <td>{{ $value['MLModelType'] }}</td>
                        <td>{{ $value['LastUpdatedAt'] }}</td>
                        <td>
                            <a class="btn btn-info btn-sm btn-list" href="/ml/getdatasource/{{ $value['MLModelId'] }}"><span class="glyphicon glyphicon-info-sign"></span></a>
                            <a class="btn btn-danger btn-sm btn-list" href="/ml/delete/{{ $value['MLModelId'] }}"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div id="describeEvaluations" class="tab-pane fade">
                <div class="col-md-4">
                    <button class="btn btn-primary btn-create-evaluations pull-right">Create Evaluations</button>
                    <form class="create-evaluations" method="post" action="{{ action('MLController@createDataSourceFromS3') }}">
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
                <table class="table table-bordered table-font text-center">               
                    <tr class="active">
                         <td>EvaluationId</td>
                        <td>Name</td>
                        <td>Status</td>
                        <td>BinaryAUC</td>               
                        <td>MLModelId</td>
                        <td>EvaluationDataSourceId</td>
                        <td>Last Updated</td>
                        <td>&nbsp;</td>
                    </tr>
                    @foreach($result['describeEvaluations'] as $key => $value)
                    <tr>
                        <td>{{ $value['EvaluationId'] }}</td>
                        <td>{{ $value['Name'] }}</td>
                        <td>{{ $value['Status'] }}</td>
                        <td>{{ $value['PerformanceMetrics']['Properties']['BinaryAUC'] }}</td>                   
                        <td>{{ $value['MLModelId'] }}</td>
                        <td>{{ $value['EvaluationDataSourceId'] }}</td>
                        <td>{{ $value['LastUpdatedAt'] }}</td>
                        <td>
                            <a class="btn btn-info btn-sm btn-list" href="/ml/getdatasource/{{ $value['EvaluationId'] }}"><span class="glyphicon glyphicon-info-sign"></span></a>
                            <a class="btn btn-danger btn-sm btn-list" href="/ml/delete/{{ $value['EvaluationId'] }}"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div id="describeBatchPredictions" class="tab-pane fade">
                <div class="col-md-4">
                    <button class="btn btn-primary btn-create-bath-description pull-right">Create Bath Description</button>
                    <form class="create-bath-description" method="post" action="{{ action('MLController@createDataSourceFromS3') }}">
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
                <table class="table table-bordered table-font text-center">
                    <tr class="active">
                         <td>BatchPredictionId</td>
                        <td>Name</td>
                        <td>Status</td>
                        <td>MLModelId</td>
                        <td>BatchPredictionDataSourceId</td>
                        <td>OutputUri</td>
                        <td>OutputUri</td>
                        <td>TotalRecordCount</td>
                        <td>&nbsp;</td>
                    </tr>
                    @foreach($result['describeBatchPredictions'] as $key => $value)
                    <tr>
                        <td>{{ $value['BatchPredictionId'] }}</td>
                        <td>{{ $value['Name'] }}</td>
                        <td>{{ $value['Status'] }}</td>
                        <td>{{ $value['MLModelId'] }}</td>
                        <td>{{ $value['BatchPredictionDataSourceId'] }}</td>
                        <td>{{ $value['OutputUri'] }}</td>                        
                        <td>
                            @if (isset($value['TotalRecordCount']) > 0)
                            {{ $value['TotalRecordCount'] }}
                            @endif
                        </td>
                        <td>{{ $value['LastUpdatedAt'] }}</td>
                        <td>
                            <a class="btn btn-info btn-sm btn-list" href="/ml/getdatasource/{{ $value['BatchPredictionId'] }}"><span class="glyphicon glyphicon-info-sign"></span></a>
                            <a class="btn btn-danger btn-sm btn-list" href="/ml/delete/{{ $value['BatchPredictionId'] }}"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>   
        </div>
    </div>  
</div>

       



@stop
