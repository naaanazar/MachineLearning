<?php
namespace liw\app\twitter;

use liw\app\twitter\Connection;

class User
{
    private $userID;
    public function signUp($login, $email, $password)
    {
        try {
            $conn = Connection::getConnection();
            $stmt = $conn->prepare("INSERT INTO `user` (`login`, `email`, `password`) VALUES (:login, :email, :password)");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $this->userID = $conn->lastInsertId();
            echo "New user was added successfull!";
            return $this->userID;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        $conn = NULL;
    }
    public function addTwit($userID, $message)
    {
         try {
            $conn = Connection::getConnection();
            $stmt = $conn->prepare("INSERT INTO `AddT` (`userID`, `message`) VALUES (:userID, :message)");
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':message', $message);
            $stmt->execute();
            $this->userID = $conn->lastInsertId();
            echo "Your post was added succesfull!";
            return $this->userID;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        $conn = NULL;
    }
    public function getPost($userID)
    {
        $post = array();
         try {
            $conn = Connection::getConnection();
            $stmt = $conn->prepare('SELECT * FROM `AddT` WHERE `userID` = :userId' );
            $stmt->bindParam(':userId', $userID);
            $stmt->execute();
            while ($posts = $stmt->fetchObject()) {
                array_push($post, $posts);
            }
            return $post;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        $conn = NULL;
    }
     public function addFollow($userID, $followID)
    {
        try {
            $conn = Connection::getConnection();
            $stmt = $conn->prepare("INSERT INTO `folowers` (`userID`, `followID`) VALUES (:userID, :followID)");
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':followID', $followID);
            $stmt->execute();
            $this->userID = $conn->lastInsertId();
            echo "Your follow";
            return $this->userID;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        $conn = NULL;
    }
    public function delFollow($userID, $followID)
    {
        try {
            $conn = Connection::getConnection();
            $stmt = $conn->prepare("DELETE FROM `folowers` WHERE `userID`=:userID AND `followID`=:followID");
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':followID', $followID);
            $stmt->execute();
            $this->userID = $conn->lastInsertId();
            echo "Your follow";
            return $this->userID;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        $conn = NULL;
    }
    public function getFollowers($userID)
    {
        $post = array();
         try {
            $conn = Connection::getConnection();
            $stmt = $conn->prepare('SELECT `followID` FROM `folowers` WHERE `userID` = :userId' );
            $stmt->bindParam(':userId', $userID);
            $stmt->execute();
            while ($posts = $stmt->fetchObject()) {
                array_push($post, $posts);
            }
            return $post;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        $conn = NULL;
    }
    public function getUsers()
    {
        $post = array();
         try {
            $conn = Connection::getConnection();
            $stmt = $conn->prepare( 'SELECT * FROM `user`' );
            $stmt->bindParam(':userId', $userID);
            $stmt->execute();
            while ($posts = $stmt->fetchObject()) {
                array_push($post, $posts);
            }
            return $post;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        $conn = NULL;
    }
}