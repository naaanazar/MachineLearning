<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>
            $.ajaxSetup({
                 headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
            }); 

            $(document).ready(function() {
                $('.delete').on('click', function(e) {
                    e.preventDefault();
                    $.post( $(e.target).attr('href'), function(data) {
                        if(data.success) {
                             $(e.target).closest('.container').fadeOut();
                        }
                    });
                });
                
                $('.restore').on('click', function(e) {
                    e.preventDefault();
                    $.post( $(e.target).attr('href'), function(data) {
                        if(data.success) {
                            $(e.target).closest('.container').fadeOut();
                        }
                    });
                });
//                $('.forseDelete').on('click', function(e) {
//                    e.preventDefault();
//                    $.post( $(e.target).attr('href'), function(data) {
//                        if(data.success) {
//                             alert('restor');
//                        }
//                    });
//                });
            });
        </script>
        <!-- Bootstrap -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <ul class="nav nav-tabs">
                <a href="http://laravel.loc/products"><button type="submit" class="btn btn-default">Products</button></a>
                <a href="http://laravel.loc/products/add"><button type="submit" class="btn btn-default">Add</button></a>
                <!--<a href="http://laravel.loc/products/edit"><button type="submit" class="btn btn-default">edit</button></a>-->
            </ul>
        </div>


        @yield('content')
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        @yield('script')
    </body>
</html>
