<?php
$exp = "/(\p{Lu}[\p{L}']*\s*){2}/";
$get = "Taras Omelianchuk";
    if(preg_match_all($exp,$get,$m)) {
         echo "work";
    }
    else{
        echo "fail";
    }   
          
var_dump($m);
