<?php

//Login
require_once '../app/auth/Auth.php';
$auth = new Auth;

if (isset($_POST["login"]) && isset($_POST["password"])) {

    $auth = new Auth;
    $auth->authorization($_POST["login"], $_POST["password"]);

   
}

//logout
if (isset($_POST['logout'])){
    $auth->logout();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Contact mananger</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <header class="header">
            <div class="container">
                <h1>Contact mananger</h1>
            </div>
        </header>
        <main class="main">
            <div class="container">
                <div class="form">
                    <h2>Please login</h2>
                </div>
                <div class="form">
                    <form class="login" action="login.php" method="post">

                    <input type="text" name="login" placeholder="Login" >

                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" value="Sing in"><br><br>
                </form><br>

                </div>
                <div class="form">
                    <a href="registration.php" style="color:white"><h2>Registration</h2></a>
                </div>
            </div>
        </main>
    </body>
</html>