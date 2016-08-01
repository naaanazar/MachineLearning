<?php 
session_start();
$user_id = $_SESSION['user_id'];
?>
<?php
    ini_set('display_erroros', 1);

    require __DIR__ . '/../vendor/autoload.php';

    use project\application\SignIn;

    $signIn = new SignIn();

    $signIn->signIn();
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=425px, user-scalable=no">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

  <title>Twitter</title>
</head>
<body>
  <div class="container" style="zoom:125%;">
    <h3>Twitter</h3>
    <?php
    if($user_id){
      include "./dashboard.php";
      exit;
    }
    ?>
    <form role="form" action="index.php" method="POST" style="width:300px;">
      <div class="input-group" style="margin-bottom:10px;">
        <span class="input-group-addon">@</span>
        <input type="text" class="form-control" placeholder="Username" name="username">
      </div>
      <input type="password" style="margin-bottom:10px;" class="form-control" placeholder="Password" name="password">
      <?php
      if($error_msg){
          echo "<div class='alert alert-danger'>".$error_msg."</div>";
      }
      ?>
      <div class="btn-group">
          <a href="register.php" style="width:150px;" class="btn btn-success">Register</a>
        <button type="submit" style="width:150px;height: 33.3px;" class="btn btn-info" name="login-btn" value="login-submit">Log In</button>
      </div>
    </form>
  </div>
</body>
</html>
