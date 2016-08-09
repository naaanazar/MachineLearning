<?php
$array = array(2,1,3,6,5,8,7);
var_dump($array);
echo "sorting";
asort($array);
var_dump($array);
echo "Longest Consecutive Sequence";






/*
$two_dimensional_array = array();
 
for ($i = 0; $i < 10; $i++) 
{
  for ($j = 0; $j < 10; $j++) 
  {
    $two_dimensional_array[$i][$j] = rand(0, 1);
  }
}
foreach($two_dimensional_array as $item) {
    foreach ($item as $key => $value) {
        echo "$value ";
    }    
    echo "<br />";
}


?>