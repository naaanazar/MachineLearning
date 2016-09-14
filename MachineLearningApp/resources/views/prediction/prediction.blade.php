@extends('main')

@section('content')

<div class="container">

    <h3 class="title">Real time prediction</h3>
    <br>
    <div class="progress-prediction clearfix">
        <div class="col-lg-8 col-md-8 col-ms-8 col-xs-8">
            <form class="form-horizontal form-prediction" method="post" action="{{ action('MLController@predict') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="SelectMLModelId" class="control-label batch-label text-right">ML model</label>
                    <select class="form-control batch-input" id="ml_model_id" name="ml_model_id"></select>
                </div>
                <br>
                <div class="form-group">
                    <label for="email" class="control-label batch-label text-right">Email custom domain</label>
                    <input id="email" name="email_custom_domain" type="number" class="form-control batch-input" placeholder="Number [0 or 1]" min="0" max="1" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="same-email" class="control-label batch-label text-right">Same email domain count</label>
                    <input id="same-email" name="same_email_domain_count" type="number" class="form-control batch-input" placeholder="Number" min="0" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="projects-count" class="control-label batch-label text-right">Projects count</label>
                    <input id="projects-count" name="projects_count" type="number" class="form-control batch-input" placeholder="Number" min="0" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="string-count" class="control-label batch-label text-right">Strings count</label>
                    <input id="string-count" name="strings_count" type="number" class="form-control batch-input" placeholder="Number" min="0" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="members-count" class="control-label batch-label text-right">Members count</label>
                    <input id="members-count" name="members_count" type="number" class="form-control batch-input" placeholder="Number" min="0" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="has-privat-project" class="control-label batch-label text-right">Has private project</label>
                    <input id="has-privat-project" name="has_private_project" type="number" class="form-control batch-input" placeholder="Number [0 or 1]" min="0" max="1" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="same-log-project" class="control-label batch-label text-right">Same login and project name</label>
                    <input id="same-log-project" name="same_login_and_project_name" type="number" class="form-control batch-input" placeholder="Number [0 or 1]" min="0" max="1" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="last-login" class="control-label batch-label text-right">Days after last login</label>
                    <input id="last-login" name="days_after_last_login" type="number" class="form-control batch-input" placeholder="Number" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="country" class="control-label batch-label text-right">Country</label>
                    <input id="country" name="country" type="text" class="form-control batch-input" placeholder="String" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary pull-right btn-prediction" value="Send" type="submit">
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-ms-4 col-xs-4">
            <div class="block-prediction">
                <div class="prediction-data"></div>
                <i class="spinner-prediction fa fa-spinner fa-spin"></i>
            </div>
        </div>
    </div>
</div>
@endsection

