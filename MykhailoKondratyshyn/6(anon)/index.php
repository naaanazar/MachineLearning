<?php

$fact = function ($n) use (&$fact) {
    if ($n == 1)
        return 1;

    return $fact($n - 1) * $n;
};
echo $fact(5);