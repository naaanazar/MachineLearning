<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SuperTwitter</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
    </head>
    <body>
        <div class="text-center">
            <button class="btn" data-toggle="modal" data-target="#modal-1">Sign In</button>
            <button class="btn" data-toggle="modal" data-target="#modal-2">
                <i class="fa fa-twitter"></i>Add twitt
            </button>
            <button class="btn" name="getposts" id="submit3">GetPosts</button>
        </div>
        <div class="modal" id="modal-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal">
                            <i class="glyphicon glyphicon-remove-circle"></i>
                        </button>
                        <h4 class="modal-title">Sign In</h4>
                    </div>
                    <div class="modal-body text-center">
                        <form id="form1" method="POST">
                            <input name="login" placeholder="login" required>
                            <input name="password" type="password" placeholder="password" required>
                            <input name="email" type="email" placeholder="email" required>
                            
                            <?php
                                require_once __DIR__ . '/../vendor/autoload.php';
                                use twitter\app\Twitter;

                                if(
                                    isset($_POST['login']) &&
                                    isset($_POST['password']) &&
                                    isset($_POST['email']) &&
                                    isset($_POST['submit'])
                                ) {
                                    $login = $_POST['login'];
                                    $password = $_POST['password'];
                                    $email = $_POST['email'];
                                    $user = new Twitter();
                                    $user->SignIn($login, $email, $password);
                                }
                            ?>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input class="btn" type="submit" value="Sign In" name="submit" form="form1">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modal-2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal">
                            <i class="glyphicon glyphicon-remove-circle"></i>
                        </button>
                        <h4 class="modal-title">Add twitt</h4>
                    </div>
                    <div class="modal-body text-center">
                        <form id="form2" method="POST">
                            <input name="message" placeholder="Your message..." required>

                            <?php
                                

                                if(
                                    isset($_POST['message']) &&
                                    isset($_POST['submit2'])
                                ) {
                                    $message = $_POST['message'];
                                    $user = new Twitter();
                                    $user->twitt($message);
                                }
                            ?>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input class="btn" type="submit" value="Add twitt" name="submit2" form="form2">
                    </div>

                </div>
            </div>
        </div>
        <script>
            var success = function(data)
            {
                $('#content').html(data);
            };
            $('#submit3').click(function()
            {
                $.ajax({
                    type: "POST",
                    value1: "submit3",
                    url: "../app/ajax.php",
                    success: success,
                    dataType: "html"
                });
            });
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>