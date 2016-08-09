<?php

namespace ex\app;

use PDO;

class Database
{
    private static $instance;
    private static $pdo;

    private function __construct()
    {
        try {
            self::$instance = new PDO('mysql:host=localhost;dbname=CrowdinSpace',
                    'exberser',
                    'firstuserfordatabase',
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            self::$pdo = self::$instance;
        } catch (Exception $exc) {
            die("Failed to connect" . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if ( empty(self::$instance) ) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public static function queryLog($name, $email, $password)
    {
        $setQuery = self::$pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

        $setQuery->bindParam(':name', $nameParam);
        $setQuery->bindParam(':email', $emailParam);
        $setQuery->bindParam(':password', $passwordParam);

        $nameParam = $name;
        $emailParam = $email;
        $passwordParam = $password;
        $setQuery->execute();
    }

    public static function selectUserId($name)
    {
        $sql = "SELECT * FROM users where name = '$name'";
         
        foreach (self::$pdo->query($sql) as $row) {
           $userId = $row['id'];
        }
        return $userId;
    }

    public static function queryTweet($tweet, $userId)
    {
        $setQuery = self::$pdo->prepare("INSERT INTO tweets (id_user, tweet) VALUES (:id_user, :tweet)");

        $setQuery->bindParam(':id_user', $userIdParam);
        $setQuery->bindParam(':tweet', $tweetParam);

        $userIdParam = $userId;
        $tweetParam = $tweet;
        $setQuery->execute();
    }

    public static function queryFollower($follower_id, $following_id)
    {
        $setQuery = self::$pdo->prepare("INSERT INTO followers (follower_id, following_id) VALUES (:follower_id, :following_id)");

        $setQuery->bindParam(':follower_id', $follower_idParam);
        $setQuery->bindParam(':following_id', $following_idParam);

        $follower_idParam = $follower_id;
        $following_idParam = $following_id;
        $setQuery->execute();
    }

    public static function queryUnFollower($follower_id, $following_id)
    {
        $setQuery = self::$pdo->exec("DELETE FROM followers WHERE follower_id = $follower_id and following_id = $following_id");
    }

    public static function queryGetFollowers($follower_id)
    {
        $sql = "SELECT following_id FROM followers where follower_id = '$follower_id'";
        $i = 0;
        foreach (self::$pdo->query($sql) as $row) {
           $userId[$i] = $row['following_id'];
           $i++;
        }
        return $userId;

    }
}
