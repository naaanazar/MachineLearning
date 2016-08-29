<?php

require '../app/LongestConsecutiveSequence.php';

use app\LongestConsecutiveSequence;

$arr = new LongestConsecutiveSequence();
$arr->display();
$arr->sort();
$arr->display();
$arr->consecutiveSequence();