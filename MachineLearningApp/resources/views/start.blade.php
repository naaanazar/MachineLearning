<!DOCTYPE html>
<html lang="en" >
   <head>
       <meta charset="utf-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <link rel="shortcut icon" href="{{ URL::to('images/favicon.ico') }}">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta name="csrf-token" content="{{ csrf_token() }}" />
       <!-- tde above 3 meta tags *must* come first in tde head; any otder head content must come *after* tdese tags -->
       <title>Learning App</title>
 <!-- CSS -->
       <link href="css/startPage.css" rel="stylesheet">
       <link href="css/animate.css" rel="stylesheet" >
       <!-- Bootstrap -->
       <link href="{{ URL::to('css/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
       <link href="{{ URL::to('css/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
       <link href="{{ URL::to('css/main.css') }}" rel="stylesheet">
       <script src="{{ URL::to('js/lib/jquery/jquery.min.js') }}"></script>
       <!--jGrowl-->
       <link rel="stylesheet" type="text/css" href="{{ URL::to('css/lib/jGrowl/jquery.jgrowl.min.css') }}" />

       <script src="{{ URL::to('js/lib/jGrowl/jquery.jgrowl.min.js') }}"></script>
       <script src="{{ URL::to('js/common.js') }}"></script>
       <script src="{{ URL::to('js/prediction/prediction.js') }}"></script>
       <script src="{{ URL::to('js/lib/bootstrap/bootstrap.min.js') }}"></script>
       <script src="{{ URL::to('js/back-to-top.js') }}"></script>
       <script src="{{ URL::to('js/startPage/roll-down.js') }}"></script>
       <script src="{{ URL::to('js/startPage/show-div-content.js') }}"></script>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>  


       <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
       <!-- WARNING: Respond.js doesn't work if you view tde page via file:// -->
       <!--[if lt IE 9]>
       <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
       <![endif]-->
</head>
<body id="overflow">

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('images/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 ">
                    <div class="site-heading">
                        <h1 class="animated fadeInUp" style="-webkit-animation-delay: 0.5s;">Crowdin Machine Learning Platform</h1>
                        <hr class="small">
                        <span class="subheading ">Crowdin Space</span>
                        <a href="#viewAboutContent"><button type="button" class="btn btn-primary btn-start btn-try-it animated fadeInLeft" style="-webkit-animation-delay: 0.5s;" onclick="showDiv()"> About</button></a>
                        <a href="{{ action('PredictionController@doView') }}"><button type="button" class="btn btn-primary btn-start btn-about animated fadeInRight" style="-webkit-animation-delay: 0.5s;"> Try It! </button></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div id = "ToShow" class="container content-container" style="display:none; onclick="showDiv()">
        <div class="row">
            <div class="about-posts post-1 clearfix">
                <div class="post-images col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <img src="/images/post-image-1.png">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <div id="viewAboutContent" class="post-preview">
                        <h2 class="post-title">Introducing Machine Learning</h2>
                        <h3 class="post-subtitle">
                            Machine learning (ML) can help you use historical data to make better business decisions.<br> ML algorithms discover patterns in data and construct predictive models using these patterns.<br>Then, you can use the models to make predictions on future data. <br>For example, one possible application of ML would be to predict whether or not a customer will purchase a particular product based on past behavior, and use this prediction to send a personalized promotional email to that customer.<br><br><br><hr>
                        </h3> 
                    </div>
                </div>
            </div>
            <div class="about-posts post-2 clearfix">
                <div class="post-images col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <img src="/images/post-image-2.png">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <div id="viewAboutContent" class="post-preview">
                        <h2 class="post-title">
                            Crowdin Machine Learning Platform Allow you:
                        </h2>
                        <h3 class="post-subtitle">
                            <ul>
                             <li>Create, review, and delete data sources, models, and evaluations. </li><br>
                             <li>This allows you to automate the creation of new models when new data becomes available.</li><br>
                             <li>You can also  inspect previous models, data sources, evaluations, and batch predictions for tracking and repeatability.</li>  <hr>
                             </ul>
                        </h3> 
                    </div>
                </div>
            </div>

    <!-- Footer -->

   @yield('content')
   <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"  data-placement="top"><span class="glyphicon glyphicon-chevron-up"></span></a>
</body>
</html>