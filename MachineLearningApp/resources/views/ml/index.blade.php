@extends('main')

@section('content')

    <script src="{{ URL::to('js/ml/tabDataSource.js') }}"></script>
    <script src="{{ URL::to('js/ml/tabMLModel.js') }}"></script>
    <script src="{{ URL::to('js/ml/tabEvaluation.js') }}"></script>
    <script src="{{ URL::to('js/ml/tabBatchPredictions.js') }}"></script>

    <div class="container">
        <div class="row">
            <div class="row-lg-4 row-md-4 row-sm-4 row-xs-4 for-mobile">
                <div id="ml-button-create">
                </div>
                <h2 class="title"><img class="logo-s3" src="{{ URL::to('images/aws-ML.png') }}" alt="ml">Machine
                    Learning</h2>
            </div>
            <div class="row-lg-4 row-md-4 row-sm-4 row-xs-4 tabs" >
                <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 ML-tabs" style="padding: 0">
                    <ul class="nav nav nav-tabs nav-justified ">
                        <li class="active"><a data-toggle="tab" href="#describeDataSources"
                            id="describeDataSourcesContent">Data Source</a></li>
                        <li><a data-toggle="tab" href="#describeMLModels" id="describeMLModelsContent">ML Models</a>
                        </li>
                        <li><a data-toggle="tab" href="#describeEvaluations"
                            id="describeEvaluationsContent">Evaluations</a>
                        </li>
                        <li><a data-toggle="tab" href="#describeBatchPredictions" id="describeBatchPredictionsContent">Batch Predictions</a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-content col-md-12">
                <div id="describeDataSources" class="tab-pane fade in active">
                    <div class="">
                        <form class="create-datasource-form" style="display:none;" method="post"
                             action="ml/create-datasource">
                            <br>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="DataSourceName">Data source name</label>
                                <input type="text" class="form-control" id="DataSourceName"
                                       placeholder="Data source name" name="DataSourceName">
                                <span class="glyphicon glyphicon-ok form-control-feedback hide" aria-hidden="true"></span>
                            </div>
                            <div class="form-group">
                                <label for="SelectDataLocationS3">Data location S3</label>
                                <select class="form-control" id="SelectDataLocationS3" name="DataLocationS3">
                                </select>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label for="DataRearrangement">Data rearrangement Begin</label>
                                    <input type="number" class="form-control form-control-sm" id="DataRearrangementBegin"
                                           name="DataRearrangementBegin">
                                    <span class="glyphicon glyphicon-ok form-control-feedback hide" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label for="DataRearrangement">Data rearrangement End</label>
                                    <input type="number" class="form-control form-control-sm" id="DataRearrangementEnd"
                                           name="DataRearrangementEnd">
                                    <span class="glyphicon glyphicon-ok form-control-feedback hide" aria-hidden="true"></span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary submit-button">Submit</button>
                        </form>

                    <div class="container-describeDataSources table-scroll ML-tables-content">
                    </div>
                </div>
                <div id="describeMLModels" class="tab-pane fade">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <form class="create-mlmodel-form" style="display:none;" method="post"
                              action="ml/create-ml-model">
                            <br>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="MLModelName">ML model name</label>
                                <input type="text" class="form-control" id="MLModelName" placeholder="ML model name"
                                       name="MLModelName">
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
                    <div class="container-describeMLModels table-scroll-ML ML-tables-content ">
                    </div>
                </div>
                <div id="describeEvaluations" class="tab-pane fade">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <form class="create-evaluations-form" style="display:none;" method="post"
                              action="ml/create-evaluation">
                            <br>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="EvaluationName">Evaluation name</label>
                                <input type="text" class="form-control" id="EvaluationName"
                                       placeholder="Evaluation name" name="EvaluationName">
                                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                                <span id="inputSuccess3Status" class="sr-only">(success)</span>
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
                    <div class="container-describeEvaluations table-scroll-evaluation ML-tables-content">
                    </div>
                </div>
                <div id="describeBatchPredictions" class="tab-pane fade">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                       <form class="create-bath-predictios-form" style="display:none;" method="post"
                              action="ml/create-batch-prediction">
                            <br>
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="SelectBathMLModel">ML model id</label>
                                <select class="form-control" id="SelectBathMLModel" name="MLModelId">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="input-file-source" class="btn btn-primary btn-file" data-toggle="tooltip" data-placement="bottom" title="csv">
                                    <span class="glyphicon glyphicon-upload"></span>&nbsp;Upload Dataset in CSV<input id="input-file-source" type="file" name="file">
                                </label>
                                <span class="preload-s3"><i class="s3-preload fa fa-spinner fa-spin" style="font-size: 24px"></i></span>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                    <div class="container-describeBatchPredictions table-scroll-batch ML-tables-content">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <br>
    <div id="modal" class="modal">
        <div class="modal-dialog">
            <div class="center modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 align="center">Information</h2>
                </div>
                <div class="center modal-body" id="result_info">
                    <div class="row" id="modal_row">
                        <div class="loader col-md-2 col-md-offset-5" id="loader">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

