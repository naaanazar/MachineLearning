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
        $id = $this->connection->query("SELECT user_id FROM users WHERE login = \"$login\"")->fetch_array(MYSQLI_ASSOC);
        $this->user_id = $id["user_id"];
        echo "Welcome" . $login . "!";
    }

    public function twitt($message)
    {
        $query = "INSERT INTO twitts(user_id, message) VALUES (\"$this->user_id\", \"$message\")";
        $this->connection->query($query);
    }

    public function getPosts($user_id)
    {
        $query = "SELECT message FROM twitts WHERE user_id = \"$user_id\"";
        $result = $this->connection->query($query)->fetch_array(MYSQLI_ASSOC);
        foreach ($result["message"] as $key => $value) {
            echo $value . '<br>';
        }
    }

    public function follow($user_id)
    {
        $query = "INSERT INTO followers(folower_id, followed_id) VALUES (\"$this->user_id\", \"$user_id\")";
        $this->connection->query($query);
    }

    public function unfollow($user_id)
    {
        $query = "DELETE FROM followers WHERE followed_id = \"$user_id\"";
        $this->connection->query($query);
    }

    public function getFollowers($user_id)
    {
        $query = "SELECT follower_id FROM followers WHERE followed_id = \"$user_id\"";
        $result = $this->connection->query($query)->fetch_array(MYSQLI_ASSOC);
        echo "Your followers: " . '<br>';
        foreach ($result["follower_id"] as $key => $value) {
            echo $value . '<br>';
        }
    }

    public function getUsers()
    {
        $query = "SELECT user_id, login FROM users";
        $result = $this->connection->query($query)->fetch_array(MYSQLI_ASSOC);
        echo "All users: " . '<br>';
        foreach ($result["user_id"] as $key => $value) {
            echo $value . " " . $result["login"]["key"] . '<br>';
        }
    }
}
