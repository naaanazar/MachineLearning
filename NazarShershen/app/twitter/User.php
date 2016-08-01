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
    
    public function signUp($login, $email, $password)
    {        
        try {

            $conn = DBGW::getConnection();

            $stmt = $conn->prepare("INSERT INTO `users` (`login`, `email`, `password`) VALUES (:login, :email, :password)");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            
            $this->userID= $conn->lastInsertId();
            echo "New user was added!";
            return $this->userID;


        } catch (\PDOException $e) {

            echo $e->getMessage();
        }

        $conn = NULL;
    }

    public function addTweet($userID, $message)
    {
        
    }
}
