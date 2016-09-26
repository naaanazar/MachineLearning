<!DOCTYPE html>
<html lang="en">
   <head>
       <meta charset="utf-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <link rel="shortcut icon" href="{{ URL::to('images/favicon.ico') }}">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta name="csrf-token" content="{{ csrf_token() }}" />
       <!-- tde above 3 meta tags *must* come first in tde head; any otder head content must come *after* tdese tags -->
       <title>Crowdin Space Machine Learning App</title>
       <!-- Bootstrap -->
       <link href="{{ URL::to('css/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
       <link href="{{ URL::to('css/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
       <link href="{{ URL::to('css/main.css') }}" rel="stylesheet">
       <link href="{{ URL::to('css/animate.css') }}" rel="stylesheet">
       <script src="{{ URL::to('js/lib/jquery/jquery.min.js') }}"></script>
       <!--jGrowl-->
       <link rel="stylesheet" type="text/css" href="{{ URL::to('css/lib/jGrowl/jquery.jgrowl.min.css') }}" />
       <script src="{{ URL::to('js/lib/jGrowl/jquery.jgrowl.min.js') }}"></script>
       <script src="{{ URL::to('js/common.js') }}"></script>
       <script src="{{ URL::to('js/prediction/prediction.js') }}"></script>
       <script src="{{ URL::to('js/lib/bootstrap/bootstrap.min.js') }}"></script>
       <script src="{{ URL::to('js/back-to-top.js') }}"></script>
       <script src="{{ URL::to('js/bucket.js') }}"></script>

       <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
       <!-- WARNING: Respond.js doesn't work if you view tde page via file:// -->
       <!--[if lt IE 9]>
       <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
       <![endif]-->
   </head>
   <body>
       <nav class="navbar navbar-default" >
           <div class="container-fluid">
               <div class="navbar-header">
                   <a href="/"><img class="logo" alt="crowdin-space" src="{{ URL::to('images/crowdin-space.png') }}"</a></a>
                   <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                   </button>
               </div>
               <div class="collapse navbar-collapse" id="myNavbar">
                   <div class="navbar-menu">
                       <ul class="nav navbar-nav">
                           <li {{ (Request::is('prediction') ? 'class=active' : '') }}>
                               <a href="{{ action('PredictionController@doView') }}">Prediction</a>
                           </li>
                           <li {{ (Request::is('ml') ? 'class=active' : '') }}>
                               <a href="{{ action('MLController@index') }}">ML</a>
                           </li>
                           <li {{ (Request::is('s3') ? 'class=active' : '') }}>
                               <a href="{{ action('S3Controller@doIndex') }}">S3</a>
                           </li>
                           <li {{ (Request::is('generator') ? 'class=active' : '') }}>
                               <a href="{{ URL::to('generator') }}">Generator</a>
                           </li>
                       </ul>
                   </div>
               </div>
           </div>
       </nav>

       @yield('content')

       <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"  data-placement="top"><span class="glyphicon glyphicon-chevron-up"></span></a>
       <div class="footer panel panel-margin">
           <div class="panel-footer text-center">
               <span class="copy">2016 &copy; Crowdin.Space</span>
           </div>
       </div>
   </body>
</html>