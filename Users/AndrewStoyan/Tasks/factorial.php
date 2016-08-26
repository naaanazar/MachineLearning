<?php

$number = $argv[1];

$factorial = function($number) use (&$factorial)
{
    if($number == 1 || $number == 0) {
        return 1;
    }
 
    return $factorial($number - 1)*$number;
};

echo $factorial($number) . "\n";
