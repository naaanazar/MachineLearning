<?php

namespace ex\controller;

use \ex\app\Controller;
use \ex\model\Login;
use \ex\model\HomeTweet;
use \ex\app\Helper;

class Tweet extends Controller
{

    public function hometweet()
    {
        if ( !isset($_COOKIE["name"]) ) {
            header("Location: http://framework.loc/tweet/login");
        }

        $model = new HomeTweet;

        $userId = $model->getUserId($_COOKIE["name"]);

        if ( isset($_POST['enterTweet']) ) {
            $model->setTweet($_POST["tweet"], $userId);
        }
    }

    public function login()
    {
        $valid = new Helper();


        if ( isset($_COOKIE["name"]) ) {
            header("Location: http://framework.loc/tweet/hometweet");
        }
        
        if ( isset($_POST['enter']) ) {
            $name = $valid->clean($_POST['name']);
            $email = $_POST['email'];
            $password = $_POST['password'];

            setcookie("name", $name, time()+600);

            $model = new Login;
            $model->singUp($name, $email, $password);

            header("Location: http://framework.loc/tweet/hometweet");
        }
    }

    public function following()
    {
        $model = new HomeTweet;
        $follower_id = $model->getUserId($_COOKIE["name"]);

        if ( isset($_POST['follow']) ) {
            $following_id = $_POST['id'];
            
            $model->setFollower($follower_id, $following_id);
        }

        if ( isset($_POST['unFollow']) ) {
            $following_id = $_POST['id'];

            $model->UnFolower($follower_id, $following_id);
        }

        $followers = $model->getFollowers($follower_id);

    }

}
