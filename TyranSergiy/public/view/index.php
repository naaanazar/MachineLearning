<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Matrix sort</title>

    <!-- Bootstrap core CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  
    <!-- Custom styles for this template -->
    <link href="/public/css/jumbotron-narrow.css" rel="stylesheet">

  
  <body>

    <div class="container">
     
        <h3 class="text-muted"></h3>
     
      
      <div class="jumbotron">
        <h1>Matrix Sort</h1>
        
        
    <form class="form-inline" action="" method="post">
  <div class="form-group">
        <p class="lead"> Matrix size:</p>
    <label class="sr-only" for="Size">x</label>
    <div class="input-group">
      <input type="text" class="form-control" id="Size" name="Size" placeholder="size">
    </div>
    <br>
    <br>
        <p class="lead"> Sort type:</p>
         
      <div class="radio">
          <label><input type="radio" name="type" value="horizontal">Horizontal sort</label>
</div>
        <br>
<div class="radio">
  <label><input type="radio" name="type" value="diagonal">Diagonal sort</label>
</div>
        <br>
<div class="radio">
  <label><input type="radio" name="type"  value="spiral">Spiral sort</label>
</div>
        
        
        <br>
<div class="radio">
  <label><input type="radio" name="type" value="zet">Zet sort</label>
</div>
             
             
  
      <br>
      <br>
      <p><input class="btn btn-lg btn-success" type="submit" title="Sort"  value="Sort"/></p>
      
      </div>
</form>
  

      <div class="row marketing">
          
          <table class="table">
              <?php if(isset($initialMatrix)): ?>
                  
              <thead><p class="lead">Initial matrix</p></thead>
              <?php for($i = 0; $i < count($initialMatrix); $i++): ?>
              <tr>
               <?php for($j = 0; $j < count($initialMatrix); $j++): ?>
                  <td><?php  echo $initialMatrix[$i][$j]; ?></td>
                  <?php endfor;?>
              </tr>
                    <?php endfor; ?>
              
          <?php endif; ?>
          </table>
          
          
          <table class="table">
              
              <?php if(isset($array)): ?>
                  
              <thead><p class="lead">Sorted matrix</p></thead>
             <?php for($i = 0; $i < count($array); $i++): ?>
              <tr>
               <?php for($j = 0; $j < count($array); $j++): ?>
                  <td><?php  echo $array[$i][$j]; ?></td>
                  <?php endfor;?>
              </tr>
                    <?php endfor; ?>
              
          <?php endif; ?>
          </table>
          
          
      </div>

      <footer class="footer">
        <p>&copy; 2015 Company, Inc.</p>
      </footer>

    </div> <!-- /container -->
    </div>

  </body>
  <script   src="https://code.jquery.com/jquery-2.2.4.js"   integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="   crossorigin="anonymous"></script>  

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</html>
