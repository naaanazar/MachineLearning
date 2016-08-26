<<<<<<< HEAD
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
=======
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
>>>>>>> e2c7402fbd787bc1e143cb301cae8a59b679546a
