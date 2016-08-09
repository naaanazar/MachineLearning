<?php 
// error_reporting (E_All^E_Notice);
session_start();
$user_id = $_SESSION['user_id'];
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

  <title>Twitter-like-system-PHP</title>
</head>
<body>
  <div class="container" style="zoom:125%;">
    <form action="register.php" method="POST" role="form" style="width:300px;">
      <h3>Twitter-Like-System-PHP</h3>
      <h4>Register For An Account</h4>
      <?php
          require __DIR__ . '/../vendor/autoload.php';

          use project\application\SignUp;

          $signUp = new SignUp();

          $signUp->signUp();
      ?>
      <div class="input-group" style="margin-bottom:10px;">
        <span class="input-group-addon">@</span>
        <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $_POST['username']; ?>">
      </div>
      <input type="password" style="margin-bottom:10px;" class="form-control" placeholder="Password" name="password">
      <input type="password" style="margin-bottom:10px;" class="form-control" placeholder="Confirm Password" name="confirm-password">
      <?php
      if($error_msg){
          echo "<div class='alert alert-danger'>".$error_msg."</div>";
      }
      ?>
      <button type="submit" style="width:300px; margin-bottom:5px;" class="btn btn-success" name="btn" value="submit-register-form">Register</button>
      <a href="home.php" style="width:300px;height: 33.3px;" class="btn btn-info">Go Home</a>
    </form>
  </div>
</body>
</html>
