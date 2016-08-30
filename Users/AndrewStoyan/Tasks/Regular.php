<?php

$str = $argv[1];
$exp = "/" . $argv[2] . "/";

preg_match($exp, $str, $matches);

if ($matches != [] && $matches[0] == $str) {
        echo "true\n";
    } else {
        echo "false\n";
}