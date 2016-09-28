@extends('main')

@section('content')

    <script src="{{ URL::to('js/ml/ml.js') }}"></script>
    <script src="{{ URL::to('js/ml/tabDataSource.js') }}"></script>
    <script src="{{ URL::to('js/ml/tabMLModel.js') }}"></script>
    <script src="{{ URL::to('js/ml/tabEvaluation.js') }}"></script>
    <script src="{{ URL::to('js/ml/tabBatchPredictions.js') }}"></script>
    <script src="{{ URL::to('js/ml/validationForms.js') }}"></script>


    <div class="container">
        <div class="row ml-logo-block">
            <div class="col-md-5 col-md-offset-4">
                <h2 class="title">
                    <img class="logo-ML" src="{{ URL::to('images/aws-ML.png') }}" alt="ml">
                    Machine Learning
                </h2>
            </div>
        </div>
            <div class="ml-button-block">
                <div class="col-md-6 clearfix" >
                    <button class="btn-ml-model btn btn-primary btn-create-mlmodel-main pull-right btn-block btn-lg" data-toggle="modal" data-target="#modalCreateMainModel">Create ML Model</button>
                </div>
                <div class="col-md-6 clearfix">
                    <button class="btn-ml-model ml-setting btn btn-primary btn-block btn-lg">Advanced settings</button>
                </div>
            </div>
        <div class="ml-table">
            <div class="ml-table-button clearfix">
                <a href="#advancedSettings" class="ml-button-back ml-setting btn btn-primary">
                     <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                     Back
                </a>
                <div id="ml-button-create" class="pull-right"></div>
            </div>
            <div class="row-lg-6 row-md-6 row-sm-6 row-xs-6 tabs ml-tabs">
                <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 ML-tabs" style="padding: 0">
                    <ul class="nav nav nav-tabs nav-justified ">
                        <li class="active"><a data-toggle="tab" href="#describeMLModels" id="describeMLModelsContent">Models</a></li>
                        <li>
                            <a data-toggle="tab" href="#describeEvaluations" id="describeEvaluationsContent">Evaluations</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#describeBatchPredictions" id="describeBatchPredictionsContent">Batch Predictions</a>
                        </li>                        
                        <li>
                            <a data-toggle="tab" href="#describeDataSources" id="describeDataSourcesContent">Data Source</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content col-md-12">
              
                <div id="describeMLModels" class="tab-pane fade in active">

                    <div class="container-describeMLModels table-scroll-ML ML-tables-content ">
                    </div>
                </div>
                  <div id="describeDataSources" class="tab-pane fade">

                    <div class="container-describeDataSources table-scroll ML-tables-content">
                    </div>
                </div>
                <div id="describeEvaluations" class="tab-pane fade">

                    <div class="container-describeEvaluations table-scroll-evaluation ML-tables-content">
                    </div>
                </div>
                <div id="describeBatchPredictions" class="tab-pane fade">

                    <div class="container-describeBatchPredictions table-scroll-batch ML-tables-content">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="modal fade modalCreateDataSource" id="modalCreateDataSource" role="dialog">
        <div class="modal-dialog" data-clicked="">
            <div class="modal-content" id="modal-ds-id">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Datasource</h4>
                </div>
                <div class="modal-body">
                    <form class="create-datasource-form" id="create-datasource-form-id" method="post"
                          action="ml/create-datasource">
                        <br>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="DataSourceName">Datasource name</label>
                            <input type="text" class="form-control" id="DataSourceName"
                                   placeholder="Datasource name" name="DataSourceName">
                            <span class="glyphicon glyphicon-ok form-control-feedback hide" aria-hidden="true"></span>
                        </div>
                        <div class="form-group select-load">
                            <label for="SelectBuckets">Buckets</label>
                            <select class="form-control" id="SelectBuckets" name="SelectBuckets">                                 
                            </select>
                        </div>
                        <div style="display:none" class="form-group select-load select-datasource-field">
                            <label for="SelectDataLocationS3">Dataset</label>
                            <select class="form-control" id="SelectDataLocationS3" name="DataLocationS3">                               
                            </select>
                        </div>                       
                        <div class="row" align="center">
                            <input id="success-button-modal-ds" type="submit" class="btn btn-primary submit-button" value="Create" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modalCreateModel" id="modalCreateModel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-ml-id">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Model</h4>
                </div>
                <div class="modal-body">

                    <form class="create-mlmodel-form" method="post"
                          action="ml/create-ml-model">
                        <br>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="MLModelName">Model name</label>
                            <input type="text" class="form-control" id="MLModelName" placeholder="ML model name"
                                   name="MLModelName" autofocus>
                            <span class="glyphicon glyphicon-ok form-control-feedback hide" aria-hidden="true"></span>
                        </div>
                        <div class="form-group select-load">
                            <label for="SelectDataSource">Datasource name</label>
                            <select class="form-control" id="SelectDataSource" name="DataSourceId">
                            </select>
                        </div>
                        <div class="row" align="center">
                            <input id="success-button-modal-ml" type="submit" class="btn btn-primary submit-button" value="Create" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modalCreateMainModel" id="modalCreateMainModel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create  ML Model</h4>
                </div>
                <div class="modal-body">
                    <form class="create-main-mlmodel-form" method="post"
                          action="ml/create-ml-model">
                        <br>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="MLModelName">Model name</label>
                            <input type="text" class="form-control" id="MLModelName" placeholder="ML model name"
                                   name="MLModelName" autofocus>
                            <span class="glyphicon glyphicon-ok form-control-feedback hide" aria-hidden="true"></span>
                        </div>
                        <div class="form-group select-load">
                            <label for="SelectBucketsMain">Buckets</label>
                            <select class="form-control" id="SelectBucketsMain" name="SelectBuckets">
                            </select>
                        </div>
                        <div style="display:none" class="form-group select-load select-datasource-field-main">
                            <label for="SelectDataLocationS3Main">Dataset</label>
                            <select class="form-control" id="SelectDataLocationS3Main" name="DataLocationS3">
                            </select>
                        </div>
                        <div class="row" align="center">
                            <input id="success-button-modal-ml" type="submit" class="btn btn-primary submit-button" value="Create" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modalCreateEvaluation" id="modalCreateEvaluation" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-ev-id">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Evaluation</h4>
                </div>
                <div class="modal-body">
                    <form class="create-evaluations-form" method="post"
                          action="ml/create-evaluation">
                        <br>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="EvaluationName">Evaluation name</label>
                            <input type="text" class="form-control" id="EvaluationName"
                                   placeholder="Evaluation name" name="EvaluationName" autofocus>
                            <span class="glyphicon glyphicon-ok form-control-feedback hide" aria-hidden="true"></span>
                        </div>
                        <div class="form-group select-load">
                            <label for="SelectMLModelId">Model name</label>
                            <select class="form-control" id="SelectMLModelId" name="MLModelId">
                            </select>
                        </div>
                        <div class="form-group select-load">
                            <label for="SelectEvDataSource">Datasource name</label>
                            <select class="form-control" id="SelectEvDataSource" name="DataSourceId">
                            </select>
                        </div>
                        <div class="row" align="center">
                            <input id="success-button-modal-ev" type="submit" class="btn btn-primary submit-button" value="Create" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modalCreateBatchPrediction" id="modalCreateBatchPrediction" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-bp-id">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Batch prediction</h4>
                </div>
                <div class="modal-body">
                    <form class="create-bath-predictios-form modal-body" method="post"
                          action="ml/create-batch-prediction">
                        <br>
                        {{ csrf_field() }}
                        <div class="form-group select-load" style="position: relative">
                            <label for="SelectBathMLModel">Model name</label>
                            <select class="form-control" id="SelectBathMLModel" name="MLModelId">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="input-file-source" class="btn btn-primary btn-file" data-toggle="tooltip" data-placement="bottom" title="csv">
                                <span class="glyphicon glyphicon-upload"></span>&nbsp;Choose dataset file
                                <input id="input-file-source" type="file" name="file" accept=".csv">
                            </label>
                            <span class="preload-s3"><i class="s3-preload fa fa-spinner fa-spin" style="font-size: 24px"></i></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div id="modal" class="modal modal-1 fade">
        <div class="modal-dialog">
            <div class="center modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 align="center">Information</h2>
                </div>
                <div class="center modal-body modal-body-1" id="result_info">
                    <div class="row" id="modal_row">
                        <div class="loader col-md-2 col-md-offset-5" id="loader">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop