<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace arr\app\twitter;

use arr\app\twitter\DBGW;

/**
 * Description of User
 *
 * @author Nazar
 */
class User
{
    private $userID;
    private $conn;

    public function __construct()
    {
        $this->conn = DBGW::getConnection();
    }

    public function signUp($login, $email, $password)
    {        
        try {

            $stmt = $this->conn->prepare("INSERT INTO `users` (`login`, `email`, `password`) VALUES (:login, :email, :password)");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            
            $this->userID= $this->conn->lastInsertId();
            return $this->userID;


        } catch (\PDOException $e) {

            echo $e->getMessage();
        }

        $this->conn = NULL;
    }

    public function tweet($userID, $post_content)
    {
        try {

            $stmt = $this->conn->prepare("INSERT INTO `posts` (`userId`, `post_content`) VALUES (:userId, :post_content)");
            $stmt->bindParam(':userId', $userID);
            $stmt->bindParam(':post_content', $post_content);
            $stmt->execute();

        } catch (\PDOException $e) {

            echo $e->getMessage();
        }

        $conn = NULL;
    }

    public function getPosts($userID)
    {
        $posts = array();
        
        try {

            $stmt = $this->conn->prepare("SELECT * FROM `posts` WHERE `userId` = :userId");
            $stmt->bindParam(':userId', $userID);
            $stmt->execute();
            while($post = $stmt->fetchObject()) {
                array_push($posts, $post);
            }

            return $posts;

        } catch (\PDOException $e) {

            echo $e->getMessage();
        }

        $conn = NULL;
    }

    public function follow($userID, $followerID)
    {
        try {

            $stmt = $this->conn->prepare("INSERT INTO `followers` (`userId`, `followerId`) VALUES (:userId, :followerId)");
            $stmt->bindParam(':userId', $userID);
            $stmt->bindParam(':followerId', $followerID);
            $stmt->execute();

        } catch (\PDOException $e) {

            echo $e->getMessage();
        }

        $conn = NULL;
    }

    public function unFollow($userID, $followerID)
    {
        try {

            $stmt = $this->conn->prepare("DELETE FROM `followers` WHERE `userId` = :userId AND `followerId` = :followerId");
            $stmt->bindParam(':userId', $userID);
            $stmt->bindParam(':followerId', $followerID);
            $stmt->execute();

        } catch (\PDOException $e) {

            echo $e->getMessage();
        }

        $conn = NULL;
    }

    public function getFollowers($userID)
    {
        $folowers = array();

        try {

            $stmt = $this->conn->prepare("SELECT followers.followerId as ID, users.login, users.email FROM followers INNER JOIN users ON followers.followerId = users.ID WHERE followers.userId = :userId");
            $stmt->bindParam(':userId', $userID);
            $stmt->execute();

            while($follower = $stmt->fetchObject()) {
                array_push($folowers, $follower);
            }

            return $folowers;

        } catch (\PDOException $e) {

            echo $e->getMessage();
        }

        $conn = NULL;
    }
   
}
