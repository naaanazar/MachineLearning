<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>4</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h2>Regex</h2>
                <form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="form-group">
                        <label class="control-label" for="name">First Name:</label>
                        <input class="form-control" id="name" type="text" name="name" placeholder="Your name" required>
                    </div>
                    <input class="btn btn-primary" type="submit" value="submit">
                </form>
                <br>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (empty($_POST["name"])) {
                            $name = "";
                        } else {
                            $name = validInput($_POST["name"]);
                            if (!preg_match("/^[a-z ,.'-]+$/i", $name)) {
                               echo "<span class='alert alert-danger'>Invalid Name</span>"; 
                            } else {
                                echo $name;
                            }
                        }
                    }

                    function validInput($data)
                    {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>