<?php

require_once 'DB/QueriesToDB.php';

class Tweet
{
    public function createTweet($user_id, $msg)
    {
        $DB = new QueriesToDB;
        $sql="INSERT INTO tweet (user_id, tweet)
			   VALUES ('" . $_SESSION['users_id'] . "','$msg')";
        $result = $DB->insertOrUpdateDB($sql);

    }
    
    public function getPost($user_id)
    {
        $DB = new QueriesToDB;
        $sql = "SELECT tweet FROM tweet  WHERE user_id = $user_id";
        $result = $DB->selectDB($sql);
        ob_start();

        if (mysqli_num_rows($result) >  0){
            $i = 1;

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<br>".$i . '_ _ _' . $row['tweet']. "<br>";
                $i++;
            }
        }
        $res = ob_get_contents();
        ob_end_clean();
        
        return $res;

    }
    
    public function userList()
    {        
        $DB = new QueriesToDB;
        $sql = "SELECT id, user FROM users";
        $result = $DB->selectDB($sql);

        if (mysqli_num_rows($result) >  0) {          
           return $result;
        }
    }

    public function userListView()
    {
        ob_start();
        $result = $this->userList();

        if ($result) {

            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['id'] != $_SESSION['users_id']) {
                    echo $row['user']. "_ _ id _ _ ".  $row['id'] . "<br>";
                }
                                
            }
        }
        $res = ob_get_contents();
        ob_end_clean();

        return $res;
    }

    public function follows($user_id)
    {
        $DB = new QueriesToDB;
        $sql = "SELECT * FROM   users   INNER JOIN   follow    ON users.id = follow.follow_user_id and follow.user_id = " . $user_id;
        $result = $DB->selectDB($sql);
        ob_start();
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['user']. "_ _ id _ _ ".  $row['follow_user_id'] . "<br>";
        }
        $follows = ob_get_contents();
        ob_end_clean();

        return $follows;
    }    
    

    public function setFollow($follow_user_id, $user_id)
    {        
        $DB = new QueriesToDB; 
        $sql = "SELECT * FROM follow WHERE user_id = $user_id AND follow_user_id= $follow_user_id";
        $result = $DB->selectDB($sql);

        if (mysqli_num_rows($result) < 1) {            
            $sql = "INSERT INTO follow (user_id, follow_user_id)
                 VALUES ('$user_id','$follow_user_id')";
            $DB->insertOrUpdateDB($sql);
        }
    }   

     public function unFollow($follow_user_id)
    {
        $DB = new QueriesToDB;
        $sql = "DELETE FROM follow WHERE follow_user_id = '". $follow_user_id . "'";
        $result = $DB->selectDB($sql);
    }



}

