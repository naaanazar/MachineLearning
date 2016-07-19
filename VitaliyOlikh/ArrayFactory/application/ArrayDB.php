<?php

namespace project\application;

class ArrayDB
{
    public static function connectDB()
    {     
        $conn = mysqli_connect("localhost", "root", "", "ArrDB");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            return $conn;
        }
    }
}
