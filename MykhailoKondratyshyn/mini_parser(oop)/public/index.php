<?php

require '../app/MiniParserController.php';


$parser = new MiniParserController;

$parser->parser();
$parser->toObject();