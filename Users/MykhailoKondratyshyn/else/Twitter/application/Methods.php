<?php

namespace dregan\application;

use PDO;
use dregan\database\Db;

/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 11.07.16
 * Time: 23:45
 */
class Methods extends SignUp
{
    protected $follower_id = 49;
    protected $following_id = 50;


    public function tweet($us_id, $message)
    {
        //$user_id = $this->userId();

        echo $us_id;
        echo $message;
        $this->db->query("INSERT INTO `twitter_message`(`User_id`, `message`) VALUES ('$us_id', '$message')");

    }


    public function getPosts($us_id)
    {
        $result = $this->db->query("SELECT * FROM `twitter_message` WHERE User_id = '$us_id'");


        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            //var_dump($row);
        }
    }


    public function follow($follower_id, $following_id)
    {
//        $follower_id = $this->follower_id;
//        $following_id = $this->following_id;

       $this->db->query("INSERT INTO `follow`(`Follower_id`, `Following_id`) VALUES ('$follower_id', '$following_id')");
    }


    public function unFollow($follower_id)
    {
        //$follower_id = $this->follower_id;
        $this->db->query("DELETE FROM `follow` WHERE Follower_id = '$follower_id'");
    }


    public function getFollowers($us_id)
    {
        $follower_id = $us_id;

        $result = $this->db->query("SELECT Following_id FROM `follow` WHERE Follower_id = '$follower_id'");


        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $listOfFollowings = (implode($row));
            $resultt = $this->db->query("SELECT Login FROM `twitter` WHERE Id = '$listOfFollowings'");

            while ($roww = $resultt->fetch(PDO::FETCH_ASSOC)) {
                var_dump($roww);
            }
        }
    }

}