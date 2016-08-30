<?php

namespace Projarr\App;

use Projarr\App\DBConnect;
use PDO;

class Follow {

    public function __construct()
    {
        $this->db = DBConnect::dbConnect();
    }
    
    public function follow($userId1, $userId2)
    {
        $this->db->query("INSERT INTO `follower` (`user1_id`, `user2_id`) VALUES ('$userId1', '$userId2')");
        echo '<br /><br />user '.$userId1.' follower user '.$userId2;
    }

    public function unfollow($userId1, $userId2)
    {
//        $this->db->query(sprintf("DELETE FROM `follower` WHERE `user1_id` = '%s', `user2_id` = '%s'", $userId1,$userId2));
        $this->db->query("DELETE FROM `follower` WHERE `user1_id` = '$userId1' AND `user2_id` = '$userId2'");
        echo '<br /><br />user '.$userId1.' unfollower user '. $userId2;
    }

    public function getFollowers($userId1)
    {
        echo '<br /><br />user '.$userId1.' follow:';
        $request = $this->db->query("SELECT `id_follower` FROM `follower` WHERE `user1_id` = '$userId1'");
        while ($row = $request->fetch(PDO::FETCH_ASSOC)) {
            $listOfFollowings = (implode($row));
            $resultt = $this->db->query("SELECT `login` FROM `user` WHERE `id_user` = '$listOfFollowings'");
            while ($row2 = $resultt->fetch(PDO::FETCH_ASSOC)) {
                echo '<br>';
                print_r($row2);
            }
        }
    }
}
