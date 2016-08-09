<?php



$login = 'text';

$login_shablon = "/^[a-zA-Z][_.a-zA-Z0-9]{2,}$/";


if (preg_match($login_shablon, $login)){
    echo "OK";
}else{
    echo "Not ok";
}