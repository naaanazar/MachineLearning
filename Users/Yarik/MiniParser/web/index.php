<?php

require '../app/Parser.php';

use App\Parser;

//$str = '123';
//$str = '111,222,444,555';
$str = '[123,[111,[222,444]],555]';

$n = new Parser();
$n->parser($str);
