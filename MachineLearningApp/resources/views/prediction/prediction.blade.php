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
                    <input id="email" name="email_custom_domain" type="number" class="form-control batch-input" placeholder="Integer [0 or 1]" min="0" max="1" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="same-email" class="control-label batch-label text-right">Same email domain count</label>
                    <input id="same-email" name="same_email_domain_count" type="number" class="form-control batch-input" placeholder="Integer" min="0" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="projects-count" class="control-label batch-label text-right">Projects count</label>
                    <input id="projects-count" name="projects_count" type="number" class="form-control batch-input" placeholder="Integer" min="0" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="string-count" class="control-label batch-label text-right">Strings count</label>
                    <input id="string-count" name="strings_count" type="number" class="form-control batch-input" placeholder="Integer" min="0" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="members-count" class="control-label batch-label text-right">Members count</label>
                    <input id="members-count" name="members_count" type="number" class="form-control batch-input" placeholder="Integer" min="0" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="has-privat-project" class="control-label batch-label text-right">Has private project</label>
                    <input id="has-privat-project" name="has_private_project" type="number" class="form-control batch-input" placeholder="Integer [0 or 1]" min="0" max="1" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="same-log-project" class="control-label batch-label text-right">Same login and project name</label>
                    <input id="same-log-project" name="same_login_and_project_name" type="number" class="form-control batch-input" placeholder="Integer [0 or 1]" min="0" max="1" required>
                    <div class="pred-error"></div>
                </div>
                <div class="form-group">
                    <label for="last-login" class="control-label batch-label text-right">Days after last login</label>
                    <input id="last-login" name="days_after_last_login" type="number" class="form-control batch-input" placeholder="Integer" required>
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
<hr>
<div class="container clearfix">
    <h3>List Records</h3>
    <div class="block-add">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Add&nbsp;<span class="glyphicon glyphicon-plus"></span></button>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Add Record</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="email-2" class="control-label batch-label text-right">Email custom domain</label>
                                <input id="email-2" type="text" class="form-control batch-input" placeholder="Email custom domain">
                            </div>
                            <div class="form-group">
                                <label for="same-email-2" class="control-label batch-label text-right">Same email domain count</label>
                                <input id="same-email-2" type="text" class="form-control batch-input" placeholder="Same email domain count">
                            </div>
                            <div class="form-group">
                                <label for="projects-count-2" class="control-label batch-label text-right">Projects count</label>
                                <input id="projects-count-2" type="text" class="form-control batch-input" placeholder="Projects count">
                            </div>
                            <div class="form-group">
                                <label for="string-count-2" class="control-label batch-label text-right">Strings count</label>
                                <input id="string-count-2" type="text" class="form-control batch-input" placeholder="Strings count">
                            </div>
                            <div class="form-group">
                                <label for="members-count-2" class="control-label batch-label text-right">Members count</label>
                                <input id="members-count-2" type="text" class="form-control batch-input" placeholder="Members count">
                            </div>
                            <div class="form-group">
                                <label for="has-privat-project-2" class="control-label batch-label text-right">Has private project</label>
                                <input id="has-privat-project-2" type="text" class="form-control batch-input" placeholder="Has private project">
                            </div>
                            <div class="form-group">
                                <label for="same-log-project-2" class="control-label batch-label text-right">Same login and project name</label>
                                <input id="same-log-project-2" type="text" class="form-control batch-input" placeholder="Same login and project name">
                            </div>
                            <div class="form-group">
                                <label for="last-login-2" class="control-label batch-label text-right">Days after last login</label>
                                <input id="last-login-2" type="text" class="form-control batch-input" placeholder="Days after last login">
                            </div>
                            <div class="form-group">
                                <label for="country-2" class="control-label batch-label text-right">Country</label>
                                <input id="country-2" type="text" class="form-control batch-input" placeholder="Country">
                            </div>
                            <div class="form-group">
                                <label for="purchase-2" class="control-label batch-label text-right">Purchase</label>
                                <input id="purchase-2" type="text" class="form-control batch-input" placeholder="Purchase">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary btn-batch pull-right" type="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="pagination pagination-sm pagination-border pull-right">
        <li>
            <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li class="active active-radius"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
            <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
    <table class="table text-center table-font">
        <tr class="active">
            <td>Target</td>
            <td>Email custom domain</td>
            <td>Same email domain count</td>
            <td>Projects count</td>
            <td>Strings count</td>
            <td>Members count</td>
            <td>Has private project</td>
            <td>Same login and project name</td>
            <td>Days after last login</td>
            <td>Country</td>
            <td>Purchase</td>
            <td>&nbsp;</td>
        </tr>
        @for($i = 1; $i <= 10; $i++)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ rand(0, 1) }}</td>
            <td>{{ rand(0, 1000) }}</td>
            <td>{{ rand(0, 50) }}</td>
            <td>{{ rand(0, 3000) }}</td>
            <td>{{ rand(1, 1000) }}</td>
            <td>{{ rand(0, 1) }}</td>
            <td>{{ rand(0, 1) }}</td>
            <td>{{ rand(0, 30) }}</td>
            <td>USA</td>
            <td>{{ rand(0, 1) }}</td>
            <td>
                <a class="btn btn-default btn-sm" href=""><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-danger btn-sm" href=""><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>

        @endfor
    </table>
</div>
<br>
@endsection

