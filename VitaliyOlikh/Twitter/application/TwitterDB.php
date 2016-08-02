<?php

namespace project\application;

class TwitterDB
{
    public static function connectDB()
    {     
        $conn = mysqli_connect("localhost", "root", "", "Twitter");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            return $conn;
        }
    }
}

