<?php

namespace ex\model;

use \ex\app\Database;

class HomeTweet
{
    public function getUserId($name)
    {
        Database::getInstance();
        return Database::selectUserId($name);
    }

    public function setTweet($tweet, $userId)
    {
        Database::getInstance();
        Database::queryTweet($tweet, $userId);
    }

    public function setFollower($follower_id, $following_id)
    {
        Database::getInstance();
        Database::queryFollower($follower_id, $following_id);
    }

    public function UnFolower($follower_id, $following_id)
    {
        Database::getInstance();
        Database::queryUnFollower($follower_id, $following_id);
    }

    public function getFollowers($follower_id)
    {
        Database::getInstance();
        return Database::queryGetFollowers($follower_id);
    }
}
