<?php

$str = 'Nazar fg Korchevsky 344 ghfydtg';

$t= preg_match('([A-Z][a-z]+\s+[A-Z][a-z]+)', $str);

if ($t) {
    echo 'true';
} else {
    echo 'false';
}