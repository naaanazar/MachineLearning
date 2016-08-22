<?php


$login = 'Mykhailo Kondratyshyn';

$login_shablon = "/^[А-ЯA-Z][а-яa-z`]+\s[А-ЯA-Z][а-яa-z`]+$/";


if (preg_match($login_shablon, $login)) {
    echo "OK";
} else {
    echo "Not ok";
}