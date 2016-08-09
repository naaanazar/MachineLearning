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
                echo $row['user']. "_ _ id _ _ ".  $row['id'] . "<br>";                
            }
        }
        $res = ob_get_contents();
        ob_end_clean();

        return $res;

    }
    
    

    public function setFollow()
    {        
        $DB = new QueriesToDB;
       follow_user_id
                $sql = "SELECT * FROM follow WHERE user_id = " . $_SESSION['users_id'] ." AND follow_user_id=". $_POST['follow_user_id']";  
                $result = $DB->selectDB($sql);
               
                if (mysqli_num_rows($result) < 1) {            
                    $sql = "INSERT INTO follow (user_id, follow_user_id)
                         VALUES ('" . $_SESSION['users_id'] . "','" . $value . "')";
                    $DB->insertOrUpdateDB($sql);
               }
         
 //SELECT NOT EXISTS (SELECT * FROM `follow` WHERE user_id = 1 AND follow_user_id=4)
        
   //      INSERT INTO follow (user_id, follow_user_id)
  // VALUES (1, 2)
  // WHERE NOT EXISTS (SELECT * FROM follow WHERE user_id = 1 AND follow_user_id=5);
    }

    public function follows()
    {


    }

     public function unFollow()
    {


    }



}

