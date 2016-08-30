<?php

namespace Projarr\App;

use Projarr\App\DBConnect;
use PDO;

class Tweet{

    public function __construct()
    {
        $this->db = DBConnect::dbConnect();
    }

    public function tweet($massage, $userId)
    {
        $this->db->query("INSERT INTO `posts` (`massage`, `user_id`) VALUES ('$massage', '$userId')");
        echo '<br />Added new record!<br />';
    }

    public function getPost($userId)
    {
        $request = $this->db->query("SELECT `massage` FROM `posts` WHERE `user_id`='$userId'");
        $post = $request->fetch(PDO::FETCH_ASSOC);
        print_r($post);
        return $post;
    }
}
