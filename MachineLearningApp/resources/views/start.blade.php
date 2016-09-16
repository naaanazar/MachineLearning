<!DOCTYPE html>
<html lang="en">
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

       <script type="text/javascript">
        $(document).ready(function () {
            $("a").click(function (e) {
                var elementClick = $(this).attr("href");
                var destination = $(elementClick).offset().top;
                    $('html,body').animate({ scrollTop: destination }, 1200,'swing');
                
                return false; 
            });
        });
        </script>

       <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
       <!-- WARNING: Respond.js doesn't work if you view tde page via file:// -->
       <!--[if lt IE 9]>
       <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
       <![endif]-->
</head>
<body>


    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('images/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Crowdin Machine Learning Platform</h1>
                        <hr class="small">
                        <span class="subheading">Crowdin Space</span>
                        <a href="#viewAboutContent"><button type="button" class="btn btn-primary btn-start btn-try-it"> About</button></a>
                        <a href="{{ action('PredictionController@doView') }}"><button type="button" class="btn btn-primary btn-start btn-about"> Try It! </button></a>
                        <!-- <button type="button" class="btn btn-primary btn-start btn-about"> About </button> -->
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="about-posts post-1 clearfix">
                <div class="post-images col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <img src="/images/post-image-1.png">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <div id="viewAboutContent" class="post-preview">
                        <h2 class="post-title">
                            Introducing Machine Learning
                        </h2>
                        <h3 class="post-subtitle">
                            Machine learning (ML) can help you use historical data to make better business decisions. ML algorithms discover patterns in data and construct predictive models using these patterns. Then, you can use the models to make predictions on future data. For example, one possible application of ML would be to predict whether or not a customer will purchase a particular product based on past behavior, and use this prediction to send a personalized promotional email to that customer.<hr>
                        </h3> 
                    </div>
                </div>
            </div>

            <div class="about-posts  post-2 clearfix">
                <div class="post-images col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <img src="/images/post-image-2.png">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <div id="viewAboutContent" class="post-preview">
                        <h2 class="post-title">
                            Integrated with AWS Services for Easy Data Access
                        </h2>
                        <h3 class="post-subtitle">
                            Amazon Machine Learning makes it easy to work with data that is already stored in the AWS cloud. You can use datasets that are already stored as CSV files in Amazon S3, or query Amazon Redshift or MySQL databases in Amazon RDS to create and use ML models.<hr>
                        </h3> 
                    </div>
                </div>
            </div>

            <div class="about-posts post-3 clearfix">
                <div class="post-images col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <img src="/images/post-image-3.png">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <div id="viewAboutContent" class="post-preview">
                            <h2 class="post-title">
                                Model Evaluation and Interpretation Tools
                            </h2>
                            <h3 class="post-subtitle">
                                High-quality data is critical to building accurate predictive models, but real world datasets are frequently incomplete or inconsistent. Amazon Machine Learning provides interactive charts that help you visualize and explore your input datasets to understand data content and distribution and spot missing or incorrect data attributes. <hr>
                            </h3> 
                    </div>
                </div>
            </div>

            <div class="about-posts post-4 clearfix">
                <div class="post-images col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <img src="/images/post-image-4.png">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <div id="viewAboutContent" class="post-preview">
                            <h2 class="post-title">
                                Model Evaluation and Interpretation Tools
                            </h2>
                            <h3 class="post-subtitle">
                                Amazon Machine Learning makes it easy to understand your model’s performance by calculating industry-standard quality metrics and providing visualization of the models behavior. Amazon Machine Learning can also help you fine-tune the interpretation of the predictions. For example, if your ML model is used to classify purchases as legitimate or fraudulent, Amazon Machine Learning will help you visualize prediction results, and decide how to adjust the predictions to deliver the optimal results for your smart application. <hr>
                            </h3> 
                    </div>
                </div>
            </div>

            <div class="about-posts post-5 clearfix">
                <div class="post-images col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <img src="/images/post-image-5.png">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <div id="viewAboutContent" class="post-preview">
                            <h2 class="post-title">
                                Modeling APIs
                            </h2>
                            <h3 class="post-subtitle">
                                Amazon Machine Learning provides APIs for modeling and management that allow you to create, review, and delete data sources, models, and evaluations. This allows you to automate the creation of new models when new data becomes available. You can also use the APIs to inspect previous models, data sources, evaluations, and batch predictions for tracking and repeatability.  <hr>
                            </h3> 
                    </div>
                </div>
            </div>



        </div>
    </div>
    <hr>

    <!-- Footer -->

   @yield('content')
   <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">&copy; Crowdin space 2016</p>
                </div>
            </div>
        </div>
    </footer>
   <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"  data-placement="top"><span class="glyphicon glyphicon-chevron-up"></span></a>

</body>
</html>