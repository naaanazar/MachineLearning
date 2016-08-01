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
        ob_start();

        if (mysqli_num_rows($result) >  0) {
            $i = 1;

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<input type='checkbox' name='userList". $i . "' value='".  $row['id']. "'>" .  $row['id'] . "<br>";
                $i++;
            }
        }
        $res = ob_get_contents();
        ob_end_clean();

        return $res;

    }

    public function follow()
    {
        
        $DB = new QueriesToDB;
        foreach ($_POST as $key => $value) {
            if ($value !== "follow") {                
               $sql="INSERT INTO follow (user_id, follow_user_id)
			   VALUES (" . $_SESSION['users_id'] . "','$value') WHERE user_id = '".$_SESSION['users_id']."' AND follow_user_id <>'". $value ."' ";
               $DB->insertOrUpdateDB($sql);
            }
        }
 
    }

    public function follows()
    {


    }

     public function unFollow()
    {


    }



}

