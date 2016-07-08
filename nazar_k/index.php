<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        hgjkg
        <?php
$mx = [
   [1, 2, 3, 4, 5],
   [6, 7, 8, 9, 10],
   [11, 12, 45, 14, 15],
   [16, 17, 18, 19, 20],
   [21, 22, 33, 24, 25]
];

ob_start();
foreach ($mx as $j => $value) {

    echo '|'.$j.'|';
    foreach ($value as $i => $value) {
        echo '|'.$i.'--' . $value.'|';  
        
      //  if (mx[j][i]<$mx)
        
    }
    echo '<br>';
    
}
array_unshift($mx, null);
$mx = call_user_func_array('array_map', $mx);
foreach ($mx as $j => $value) {

    echo '|'.$j.'|';
    foreach ($value as $i => $value) {
        echo '|'.$i.'--' . $value.'|';         
    }
    echo '<br>';
    
}
$out2 = ob_get_contents();

ob_end_clean();
echo $out2;
           ?>
    </body>
</html>
