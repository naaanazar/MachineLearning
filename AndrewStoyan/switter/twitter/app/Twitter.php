<?php
namespace twitter\app;
require_once __DIR__.'/../vendor/autoload.php';

use twitter\app\DatabaseConnect;
/**
 * Description of tweeter
 *
 * @author dron
 */

class Twitter
{
    public $user_id;
    public $connection;

    public function __construct()
    {
        $this->connection = DatabaseConnect::getInstance()->doConnect();
        if ($this->connection->connect_errno) {
            die("Hadn`t connected: %s\n" . $this->connection->connect_errno);
        }
    }

    public function SignIn($login, $email, $password)
    {
        $resultpassword = md5($password);
        $query = "INSERT INTO users(login, password, email) VALUES(\"$login\", \"$resultpassword\", \"$email\")";
        $this->connection->query($query);
                
        echo "Welcome on Switter, " . $login . "!";
    }

    public function twitt($user_id, $message)
    {
        $query = "INSERT INTO twitts(user_id, message) VALUES (\"$user_id\", \"$message\")";
        $this->connection->query($query);
    }

    public function getPosts($user_id)
    {
        $query = "SELECT message FROM twitts WHERE user_id = \"$user_id\"";
        $result = $this->connection->query($query)->fetch_array(MYSQLI_NUM);
        
        for ($i = 0, $l = count($result); $i < $l; $i++) {
            echo $result[$i] . "\n";
        }
    }

    public function follow($follower_id, $user_id)
    {
        $query = "INSERT INTO followers(follower_id, followed_id) VALUES (\"$follower_id\", \"$user_id\")";
        $this->connection->query($query);
        echo 'Followed';
    }

    public function unfollow($follower_id, $user_id)
    {
        $query = "DELETE FROM followers WHERE followed_id = \"$user_id\" AND follower_id = \"$follower_id\"";
        $this->connection->query($query);
        echo 'Unfollowed';
    }

    public function getFollowers($user_id)
    {
        $query = "SELECT follower_id FROM followers WHERE followed_id = \"$user_id\"";
        $result = $this->connection->query($query);
        echo "Your followers: " . "\n";
        while($row = $result->fetch_array())
        {
            $rows[] = $row;
        }

        foreach($rows as $row)
        {
            echo $row['follower_id'] . "\n";
        }
    }

    public function getUsers()
    {
        $query = "SELECT user_id, login FROM users";
        $result = $this->connection->query($query);
        echo "All users: " . "\n";
        while($row = $result->fetch_array())
        {
            $rows[] = $row;
        }

        foreach($rows as $row)
        {
            echo $row['user_id'] . " " . $row['login'] . "\n";
        }
    }
}
