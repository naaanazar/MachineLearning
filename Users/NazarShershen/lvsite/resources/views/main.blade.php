<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Laravel</title>

        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="/css/style.css" rel="stylesheet">
        
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

          $(document).ready(function() {
              $('.delete-button').on('click', function(e) {
                  e.preventDefault();
                  $.post( $(e.target).attr('href'), function( data ) {
                       if(data.success) {
                            location.reload();
                       }
                 });
              });

              $('.permanently-delete-button').on('click', function(e) {
                  e.preventDefault();
                  $.post( $(e.target).attr('href'), function( data ) {
                       if(data.success) {
                           $(e.target).closest('div').fadeOut();
                       }
                 });
              });

              $('.restore-button').on('click', function(e) {
                  e.preventDefault();
                  $.post( $(e.target).attr('href'), function( data ) {
                       if(data.success) {
                            location.reload();
                       }
                 });
              });
          });
        </script>

    </head>
    <body>
        <div class="container-fluid">
         
            @yield('content')
            
        </div>
    </body>
</html>