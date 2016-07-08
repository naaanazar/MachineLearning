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

//print_r($mx);

$m = count($mx);
$n = max( array_map( 'count',  $mx ) );

for ($k = 0; $k < ($m * $n); $k++){
   
    for ($i = 0; $i < $m; $i++){
      
       for ($j=0; $j<$n; $j++){
        
            if ($j != $n){
                                
                if($mx[$i][$j+1] < $mx[$i][$j]){
                    $tmp=$mx[$i][$j+1];
                    $mx[$i][$j+1]=$mx[$i][$j];
                    $mx[$i][$j]=$tmp;
                }
            }
           else{
         
                if ($mx[$i+1][$j] < $mx[$i][$j] && $i != $m){                    
                    $tmp=$mx[$i+1][$j];
                    $mx[$i+1][$j]=$mx[$i][$j];
                    $mx[$i][$j]=$tmp;
                }
            }
        }
    }
}
//echo  $m.'+++++<br>'.$n.'++++++<br>';

echo $mx[4][1]. '<br>';
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

print_r($mx);
        ?>
    </body>
</html>
