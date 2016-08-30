<?php

require_once '../app/DB/QueriesToDB.php';

class SingUp
{

    public function reg($user, $mail, $password, $confirm_password)
    {        
        $DB = new QueriesToDB;        

        if ($confirm_password == $password && !empty($user) && !empty($mail) && !empty($password) && !empty($confirm_password)) {

            $result = $DB->selectDB("SELECT user FROM users WHERE user = '$user'");
    
            if (!mysqli_num_rows($result) > 0) {
                echo "user exist";
                $sql="INSERT INTO users (user, password, mail)
                   VALUES ('$user','$password','$mail' )";
                $result = $DB->selectDB($sql);
                header("Location: login.php");
                exit;
            } else {
                echo "user exist";
            }

        } else {
            echo 'write all fields';
        }           
    }
}