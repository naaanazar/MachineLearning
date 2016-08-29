@extends('main')

@section('content')

<div class="container">
    <h3>Real time prediction</h3>
    <br>
    <div class="col-md-6 clearfix">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="email" class="control-label batch-label text-right">Email custom domain</label>
                <input id="email" type="text" class="form-control batch-input" placeholder="Email custom domain">
            </div>
            <div class="form-group">
                <label for="same-email" class="control-label batch-label text-right">Same email domain count</label>
                <input id="same-email" type="text" class="form-control batch-input" placeholder="Same email domain count">
            </div>
            <div class="form-group">
                <label for="projects-count" class="control-label batch-label text-right">Projects count</label>
                <input id="projects-count" type="text" class="form-control batch-input" placeholder="Projects count">
            </div>
            <div class="form-group">
                <label for="string-count" class="control-label batch-label text-right">Strings count</label>
                <input id="string-count" type="text" class="form-control batch-input" placeholder="Strings count">
            </div>
            <div class="form-group">
                <label for="members-count" class="control-label batch-label text-right">Members count</label>
                <input id="members-count" type="text" class="form-control batch-input" placeholder="Members count">
            </div>
            <div class="form-group">
                <label for="has-privat-project" class="control-label batch-label text-right">Has private project</label>
                <input id="has-privat-project" type="text" class="form-control batch-input" placeholder="Has private project">
            </div>
            <div class="form-group">
                <label for="same-log-project" class="control-label batch-label text-right">Same login and project name</label>
                <input id="same-log-project" type="text" class="form-control batch-input" placeholder="Same login and project name">
            </div>
            <div class="form-group">
                <label for="last-login" class="control-label batch-label text-right">Days after last login</label>
                <input id="last-login" type="text" class="form-control batch-input" placeholder="Days after last login">
            </div>
            <div class="form-group">
                <label for="country" class="control-label batch-label text-right">Country</label>
                <input id="country" type="text" class="form-control batch-input" placeholder="Country">
            </div>
            <div class="form-group">
                <label for="purchase" class="control-label batch-label text-right">Purchase</label>
                <input id="purchase" type="text" class="form-control batch-input" placeholder="Purchase">
            </div>
            <div class="form-group">
                <input class="btn btn-primary pull-right" value="Send" type="submit">
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="block-output"></div>
    </div>
</div>

@endsection

