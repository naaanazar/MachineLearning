<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="http://exbers.loc/style.css">
        <title>Document</title>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <style>
            canvas {
                background-color: #f1f1f1;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="navbar navbar-inverse">
                    <div class="container">
                        <div class="navbar-header">
                            <!-- <a href="#" class="navbar-brand">ex</a> -->
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
                                <span class="sr-only">Open menu</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="responsive-menu">
                            <ul class="nav navbar-nav">
                                <li><a href="http://framework.loc/tweet/hometweet">Home</a></li>
                                <li><a href="http://framework.loc/tweet/following">follower</a></li>
                                <li><a href="#">test</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <h1>
                    Login
                </h1>
            </div>
        </div>

        <div class="container">
            <form class="form-horizontal" method="post" action="http://framework.loc/tweet/login">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" name="enter">Sign in</button>
                    </div>
                </div>
            </form>
        </div>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>