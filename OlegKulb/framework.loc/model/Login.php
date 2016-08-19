<?php

namespace ex\model;

use \ex\app\Database;

class Login
{
    public function singUp($name, $email, $password)
    {
        Database::getInstance();
        Database::queryLog($name, $email, $password);
    }
}
