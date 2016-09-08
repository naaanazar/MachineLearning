@extends('main')

@section('content')

    <div class="container">
        <div class = "row" >
            <div class="row-lg-6 row-md-6 row-sm-6 row-xs-6">
                <h2 class="title"><img class="logo-s3" src="{{ URL::to('images/aws-ML.png') }}" alt="ml">Machine Learning</h2>
            </div>
            <div class="row-lg-6 row-md-6 row-sm-6 row-xs-6">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding: 0">
                    <ul class="nav nav nav-tabs nav-justified">
                        <li class="active"><a data-toggle="tab" href="#describeDataSources">Data Source</a></li>
                        <li><a data-toggle="tab" href="#describeMLModels">ML Models</a></li>
                        <li><a data-toggle="tab" href="#describeEvaluations">Evaluations</a></li>
                        <li><a data-toggle="tab" href="#describeBatchPredictions">Batch Predictions</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="describeDataSources" class="tab-pane fade in active">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <button class="btn btn-primary btn-create-datasource pull-right">Create Datasource</button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <form class="create-datasource" style="display:none;" method="post" action="{{ action('MLController@createDataSourceFromS3') }}">
                                <br>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="DataSourceName">Data source name</label>
                                    <input type="text" class="form-control" id="DataSourceName" placeholder="Data source name" name="DataSourceName">
                                </div>
                                <div class="form-group">
                                    <label for="SelectDataLocationS3">Data location S3</label>
                                    <select class="form-control" id="SelectDataLocationS3" name="DataLocationS3">
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="DataRearrangement">Data rearrangement Begin</label>
                                        <input type="number" class="form-control form-control-sm" id="DataRearrangement"  name="DataRearrangementBegin">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="DataRearrangement">Data rearrangement End</label>
                                        <input type="number" class="form-control form-control-sm" id="DataRearrangement"  name="DataRearrangementEnd">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="DataSchema">Data schema</label>
                                    <textarea class="form-control" id="DataSchema" placeholder="Data schema"  rows="10" name="DataSchema"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="container-describeDataSources">
                            <table class="table table-bordered table-font text-center">
                                <tr class="active">
                                    <td>DataSourceId</td>
                                    <td>Name</td>
                                    <td>Status</td>
                                    <td>DataLocationS3</td>
                                    <td>Last Updated</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <span class="hide">{{$i = 1}}</span>
                                @foreach($result['describeDataSources'] as $key => $value)
                                    <tr>
                                        <td>{{ $value['DataSourceId'] }}</td>
                                        <td>
                                            @if (isset($value['Name']))
                                                {{ $value['Name'] }}
                                            @endif
                                        </td>
                                        <td>{{ $value['Status'] }}</td>
                                        <td>{{ $value['DataLocationS3'] }}</td>
                                        <td>{{ $value['LastUpdatedAt'] }}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"
                                               data-toggle="modal" id="info_{{ $i }}"><span
                                                        class="glyphicon glyphicon-info-sign"></span></a>
                                            <a class="btn btn-danger btn-sm btn-list delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
                                        </td>
                                    </tr>
                                    <span class="hide">{{ $i = $i+1 }}</span>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div id="describeMLModels" class="tab-pane fade">
                        <div class="create-ml-mode">
                            <button class="btn btn-primary btn-create-mlmodel pull-right">Create ML Mode</button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <form class="create-mlmodel" style="display:none;" method="post" action="{{ action('MLController@createMLModel') }}">
                                <br>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="MLModelName">ML model name</label>
                                    <input type="text" class="form-control" id="MLModelName" placeholder="ML model name" name="MLModelName">
                                </div>
                                <div class="form-group">
                                    <label for="MLModelType">ML model type</label>
                                    <select class="form-control" id="MLModelType" name="MLModelType">
                                        <option selected value="BINARY">BINARY</option>
                                        <option value="REGRESSION">REGRESSION</option>
                                        <option value="MULTICLASS">MULTICLASS</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="SelectDataSource">Data source id</label>
                                    <select class="form-control" id="SelectDataSource" name="DataSourceId">
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="container-describeMLModels">
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
                                <span class="hide">{{$i = 1}}</span>
                                @foreach($result['describeMLModels'] as $key => $value)
                                    <tr>
                                        <td>{{ $value['MLModelId'] }}</td>
                                        <td>
                                            @if (isset($value['Name']))
                                                {{ $value['Name'] }}
                                            @endif
                                        </td>
                                        <td>{{ $value['Status'] }}</td>
                                        <td>{{ $value['TrainingDataSourceId'] }}</td>
                                        <td>{{ $value['MLModelType'] }}</td>
                                        <td>{{ $value['LastUpdatedAt'] }}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"
                                               data-toggle="modal" id="info_{{ $i }}">
                                                <span class="glyphicon glyphicon-info-sign"></span></a>
                                            <a class="btn btn-danger btn-sm btn-list delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
                                        </td>
                                    </tr>
                                    <span class="hide">{{ $i = $i+1 }}</span>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div id="describeEvaluations" class="tab-pane fade">
                        <div class="create-evaluation">
                            <button class="btn btn-primary btn-create-evaluations pull-right">Create Evaluations</button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <form class="create-evaluations" style="display:none;" method="post" action="{{ action('MLController@createEvaluation') }}">
                                <br>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="EvaluationName">Evaluation name</label>
                                    <input type="text" class="form-control" id="EvaluationName" placeholder="Evaluation name" name="EvaluationName">
                                </div>
                                <div class="form-group">
                                    <label for="SelectMLModelId">ML model id</label>
                                    <select class="form-control" id="SelectMLModelId" name="MLModelId">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="SelectEvDataSource">Data source id</label>
                                    <select class="form-control" id="SelectEvDataSource" name="DataSourceId">
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="container-describeEvaluations">
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
                                <span class="hide">{{$i = 1}}</span>
                                @foreach($result['describeEvaluations'] as $key => $value)
                                    <tr>
                                        <td>{{ $value['EvaluationId'] }}</td>
                                        <td>
                                            @if (isset($value['Name']))
                                                {{ $value['Name'] }}
                                            @endif
                                        </td>
                                        <td>{{ $value['Status'] }}</td>
                                        <td>
                                            @if (isset($value['PerformanceMetrics']['Properties']['BinaryAUC']))
                                                {{ $value['PerformanceMetrics']['Properties']['BinaryAUC'] }}
                                            @endif
                                        </td>
                                        <td>{{ $value['MLModelId'] }}</td>
                                        <td>{{ $value['EvaluationDataSourceId'] }}</td>
                                        <td>{{ $value['LastUpdatedAt'] }}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"
                                               data-toggle="modal" id="info_{{ $i }}">
                                                <span class="glyphicon glyphicon-info-sign"></span></a>
                                            <a class="btn btn-danger btn-sm btn-list delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
                                        </td>
                                    </tr>
                                    <span class="hide">{{ $i = $i+1 }}</span>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div id="describeBatchPredictions" class="tab-pane fade">
                        <div class="create-bath-description">
                            <button class="btn btn-primary btn-create-bath-description pull-right">Create bath prediction</button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <form class="create-bath-descriptions" style="display:none;" method="post" action="{{ action('MLController@createBatchPrediction') }}">
                                <br>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="BatchPredictionName">Batch prediction name</label>
                                    <input type="text" class="form-control" id="BatchPredictionName" placeholder="Batch prediction name" name="BatchPredictionName">
                                </div>
                                <div class="form-group">
                                    <label for="SelectBathMLModel">ML model id</label>
                                    <select class="form-control" id="SelectBathMLModel" name="MLModelId">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="SelectBathDataSource">Batch prediction data source id</label>
                                    <select class="form-control" id="SelectBathDataSource" name="DataSourceId">
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="container-describeBatchPredictions">
                            <table class="table table-bordered table-font text-center">
                                <tr class="active">
                                    <td>BatchPredictionId</td>
                                    <td>Name</td>
                                    <td>Status</td>
                                    <td>MLModelId</td>
                                    <td>BatchPredictionDataSourceId</td>
                                    <td>OutputUri</td>
                                    <td>Count</td>
                                    <td>TotalRecordCount</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <span class="hide">{{$i = 1}}</span>
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
                                            <a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"
                                               data-toggle="modal" id="info_{{ $i }}">
                                                <span class="glyphicon glyphicon-info-sign"></span></a>
                                            <a class="btn btn-danger btn-sm btn-list delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
                                        </td>
                                    </tr>
                                    <span class="hide">{{ $i = $i+1 }}</span>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div id="modal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 align="center">Information</h2>
                </div>
                <div class="modal-body" id="result_info">

                </div>
            </div>
        </div>
    </div>
@stop

