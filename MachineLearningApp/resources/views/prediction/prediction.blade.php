@extends('main')

@section('content')
    <div class="container">
        <h3 class="title title-pred">Real time prediction</h3>
        <div class="main-prediction col-md-12 clearfix">
            <div class="block-prediction clearfix col-md-4">
                <div class="notification-pred alert alert-danger">
                    <a href="#" class="notif-close close">&times;</a>
                    <strong>Error! </strong><span class="notif-data"></span>
                </div>
                <h2 class="text-center pred-result">Prediction results</h2>
                <div class="data-prediction"></div>
                <i class="spinner-prediction fa fa-spinner fa-spin"></i>
            </div>
            <form class="form-horizontal form-prediction col-md-8 clearfix" method="post" action="{{ action('PredictionController@doPredict') }}">
                {{ csrf_field() }}
                <div class="form-group loader-ml-pred">
                    <label class="control-label label-pred ML-model" for="ml_model_id">ML model</label>
                    <select id="ml_model_id" class="form-control select-pred" name="ml_model_id"></select>
                </div>
                <hr>
                <div class="form-group">
                    <label class="control-label label-pred" for="email">Email custom domain</label>
                    <input id="email" class="form-control input-pred" name="email_custom_domain" type="number" placeholder="Number [0 or 1]" min="0" max="1">
                </div>
                <div class="form-group">
                    <label class="control-label label-pred" for="same-email">Same email domain count</label>
                    <input id="same-email" class="form-control input-pred" name="same_email_domain_count" type="number" placeholder="Number" min="0">
                </div>
                <div class="form-group">
                    <label class="control-label label-pred" for="projects-count">Projects count</label>
                    <input id="projects-count" class="form-control input-pred" name="projects_count" type="number" placeholder="Number" min="0">
                </div>
                <div class="form-group">
                    <label class="control-label label-pred" for="string-count">Strings count</label>
                    <input id="string-count" class="form-control input-pred" name="strings_count" type="number" placeholder="Number" min="0">
                </div>
                <div class="form-group">
                    <label  class="control-label label-pred" for="members-count">Members count</label>
                    <input id="members-count" class="form-control input-pred" name="members_count" type="number" placeholder="Number" min="0">
                </div>
                <div class="form-group">
                    <label class="control-label label-pred" for="has-privat-project">Has private project</label>
                    <input id="has-privat-project" class="form-control input-pred" name="has_private_project" type="number" placeholder="Number [0 or 1]" min="0" max="1">
                </div>
                <div class="form-group">
                    <label class="control-label label-pred" for="same-log-project">Same login and project name</label>
                    <input id="same-log-project" class="form-control input-pred" name="same_login_and_project_name" type="number" placeholder="Number [0 or 1]" min="0" max="1">
                </div>
                <div class="form-group">
                    <label class="control-label label-pred" for="last-login">Days after last login</label>
                    <input id="last-login" class="form-control input-pred" name="days_after_last_login" type="number" placeholder="Number">
                </div>
                <div class="form-group">
                    <label  class="control-label label-pred" for="country">Country</label>
                    <input id="country" class="form-control input-pred" name="country" type="text" placeholder="String">
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary btn-lg btn-pred" value="Send" type="submit" disabled>
                </div>
            </form>
        </div>
    </div>
@stop