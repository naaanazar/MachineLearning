<?php

require_once '../app/DB/QueriesToDB.php';

class Auth
{
    public $error;
    public $fail;

    public function authorization($login, $password) {

        $DB = new QueriesToDB;
        $sql = "SELECT id, user FROM users WHERE user='$login' and password ='$password'";
        $result = $DB->selectDB($sql);   

            if ($result) {			                

                if (mysqli_num_rows($result) == 1) {
                    session_start();
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['auth'] = 'true';
                    $_SESSION['user'] = $row['user'];
                    $_SESSION['users_id'] = $row['id'];
                    	 		
                    $_SESSION['check'] = hash('ripemd128',$_SERVER['REMOTE_ADDR'] .  $_SERVER['HTTP_USER_AGENT']);			 		
                    header("location: index.php");
                    exit;
                }
                else {
                    $log_sql =  "Wrong password or login" . "<br>" . mysqli_error($DB->getConn());
                    echo "<script>alert ('Wrong password or login') </script>";
                }
            }			
       
    }
    
    function logout(){
        session_start();
        session_unset();
        session_destroy();
        header ('location:login.php');
        exit;
    }

    function session_security(){
        session_start();
        if (!$_SESSION['auth']){
            header ("location:login.php");
            exit;
        }
        if ($_SESSION['check'] != hash('ripemd128',$_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'])){
            logout();
        }
    }
    
}

