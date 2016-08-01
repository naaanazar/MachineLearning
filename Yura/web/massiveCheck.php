<?php

$random = array(
    array(rand(1,9),rand(1,9),rand(1,9),rand(1,9),rand(1,9)),
    array(rand(1,9),rand(1,9),rand(1,9),rand(1,9),rand(1,9)),
    array(rand(1,9),rand(1,9),rand(1,9),rand(1,9),rand(1,9)),
    array(rand(1,9),rand(1,9),rand(1,9),rand(1,9),rand(1,9)),
    array(rand(1,9),rand(1,9),rand(1,9),rand(1,9),rand(1,9))
);

$massive = array(
  array(1,2,3,4,5),
  array(6,7,8,9,10),
  array(11,12,13,14,15),
  array(16,17,18,19,20),
  array(21,22,23,24,25)
    );


use yu\app\sorters\ArrayHorizontal;

if($_GET["massive"] == 1)
    {
echo json_encode ($random);
}
else if ($_GET["massive"] == 2) {
    echo json_encode ($massive);
    
}
