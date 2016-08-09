<?php



$login = 'Mykhailo Kondratyshyn';

$login_shablon = "/^[А-Я]|[A-Z][a-zA-Z]$/u";


if (preg_match($login_shablon, $login)){
    echo "OK";
}else{
    echo "Not ok";
}