<?php

require '../app/ParserTwo.php';

use app\Parser;

//$str = '123';
//$str = '111,222,444,555';
$str = '[123,[111,[222,444]],555]';

$n = new Parser();
$n->parser($str);