<?php

namespace project\application;
use project\application\TwitterDB;

class SignIn 
{
    public function signIn()
    {
        if($_POST['login-btn']=="login-submit"){
            if($_POST['username']!="" && $_POST['password']!=""){
              $username = strtolower($_POST['username']);
              include "connect.php";
              $query = mysql_query("SELECT id, password
                                    FROM users 
                                    WHERE username='$username'
                                    ");
              mysql_close($conn);
              if(mysql_num_rows($query)>=1){
                $password = md5($_POST['password']);
                $row = mysql_fetch_assoc($query);
                if($password==$row['password']){
                  $_SESSION['user_id']=$row['id'];
                  header('Location: .');
                  exit;
                }
                else{
                  $error_msg = "Incorrect username or password";
                }
              }
              else{
                $error_msg = "Incorrect username or password";
              }
            }
            else{
              $error_msg = "All fields must be filled out";
            }
          }
    }
}
