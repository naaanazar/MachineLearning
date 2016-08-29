<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="images/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- tde above 3 meta tags *must* come first in tde head; any otder head content must come *after* tdese tags -->
        <title>Crowdin Space Machine Learning App</title>
        <!-- Bootstrap -->
        <link href="{{ URL::to('css/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::to('css/main.css') }}" rel="stylesheet">
        <script src="{{ URL::to('js/lib/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::to('js/common.js') }}"></script>
        <script src="{{ URL::to('js/lib/bootstrap/bootstrap.min.js') }}"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view tde page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="">
                    <img class="logo" alt="crowdin-space" src="{{ URL::to('images/crowdin-space.png') }}">
                </a>
            </div>
                <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('/') }}">Home</a></li>
                <li><a href="{{ URL::to('/list') }}">List</a></li>
            </ul>
            <form class="navbar-form navbar-right form-upload" enctype="multipart/form-data" action="../app/S3.php" method="post">
                <div class="form-group">
                    <label for="input-file" class="btn btn-primary btn-file" data-toggle="tooltip" data-placement="bottom" title="csv">
                        Upload Dataset (csv) <input id="input-file" type="file" name="file">
                    </label>
                </div>
            </form>
            <form class="navbar-form navbar-right" enctype="multipart/form-data" action="#" method="post">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create Model</button>
                </div>
            </form>
        </nav>
