@extends('main')

@section('content')
<div class="container">
    <h3 class="pred-title title">Real time prediction</h3>
    <div class="main-prediction clearfix">
        <div class="col-lg-8 col-md-8 col-ms-12 col-xs-12 col-md-offset-2">
            <div class="block-prediction clearfix">
                <div class="prediction-data"></div>
                <i class="spinner-prediction fa fa-spinner fa-spin"></i>
            </div>
            <form class="form-horizontal form-prediction" method="post" action="{{ action('PredictionController@doPredict') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="ml_model_id" class="control-label label-pred ML-model">ML model</label>
                    <select class="form-control input-pred" id="ml_model_id" name="ml_model_id"></select>
                </div>
                <hr>
                <div class="form-group">
                    <label for="email" class="control-label label-pred">Email custom domain</label>
                    <input id="email" name="email_custom_domain" type="number" class="form-control input-pred" placeholder="Number [0 or 1]" min="0" max="1">
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="same-email" class="control-label label-pred">Same email domain count</label>
                    <input id="same-email" name="same_email_domain_count" type="number" class="form-control input-pred" placeholder="Number" min="0">
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="projects-count" class="control-label label-pred">Projects count</label>
                    <input id="projects-count" name="projects_count" type="number" class="form-control input-pred" placeholder="Number" min="0">
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="string-count" class="control-label label-pred">Strings count</label>
                    <input id="string-count" name="strings_count" type="number" class="form-control input-pred" placeholder="Number" min="0">
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="members-count" class="control-label label-pred">Members count</label>
                    <input id="members-count" name="members_count" type="number" class="form-control input-pred" placeholder="Number" min="0">
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="has-privat-project" class="control-label label-pred">Has private project</label>
                    <input id="has-privat-project" name="has_private_project" type="number" class="form-control input-pred" placeholder="Number [0 or 1]" min="0" max="1">
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="same-log-project" class="control-label label-pred">Same login and project name</label>
                    <input id="same-log-project" name="same_login_and_project_name" type="number" class="form-control input-pred" placeholder="Number [0 or 1]" min="0" max="1">
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="last-login" class="control-label label-pred">Days after last login</label>
                    <input id="last-login" name="days_after_last_login" type="number" class="form-control input-pred" placeholder="Number">
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="country" class="control-label label-pred">Country</label>
                    <input id="country" name="country" type="text" class="form-control input-pred" placeholder="String">
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary btn-lg btn-pred" value="Send" type="submit" disabled>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

