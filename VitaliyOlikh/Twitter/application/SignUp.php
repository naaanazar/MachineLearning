<?php

namespace project\application;

class SignUp
{
    public function signUp()
    {
        if($_POST['btn']=="submit-register-form"){
            if($_POST['username']!="" && $_POST['password']!="" && $_POST['confirm-password']!=""){
              if($_POST['password']==$_POST['confirm-password']){
                include 'connect.php';
                $username = strtolower($_POST['username']);
                $query = mysql_query("SELECT username 
                                      FROM users 
                                      WHERE username='$username'
                                      ");
                mysql_close($conn);
                if(!(mysql_num_rows($query)>=1)){
                    $password = md5($_POST['password']);
                    include 'connect.php';
                    mysql_query("INSERT INTO users(username, password) 
                                 VALUES ('$username', '$password')
                                ");
                    mysql_close($conn);
                    echo "<div class='alert alert-success'>Your account has been created!</div>";
                    echo "<a href='.' style='width:300px;' class='btn btn-info'>Go Home</a>";
                    echo "</form>";
                    echo "<br>";
                    echo "<div class='jumbotron' style='padding:3px;'>
                            <div class='container'>
                              <h5>Made by <a href='http://simarsingh.ca'>Simar</a></h5>  
                              <h5>This is Open Source - Fork it on <i class='fa fa-github'></i> <a href='https://github.com/iSimar/Twitter-Like-System-PHP'>GitHub</a></h5>
                            </div>
                          </div>";
                    echo "</body>";
                    echo "</html>";
                    exit;

                }
                else{
                  $error_msg="Username already exists please try again";
                }
              }
              else{
                $error_msg="Passwords did not match";
              }
            }
            else{
                $error_msg="All fields must be filled out";
            }
        }
    }
}
