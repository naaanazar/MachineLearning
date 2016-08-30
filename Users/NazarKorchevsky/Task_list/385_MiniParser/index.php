<?php
require 'MiniParser.php';

$str = '[123,345345,[456,[789,345435,[234]]],3245234]';

$P = new MiniParser;
$P->out($P->parse($str));
