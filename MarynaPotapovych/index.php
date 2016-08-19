<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

require __DIR__ .'/vendor/autoload.php'; 

/*use liw\app\ArraySorterFactory;

$factory = new ArraySorterFactory();


$sortObj = $factory->getSort("HorisontalSortClass");
$aaa = $sortObj->sortArr();

foreach ($aaa as $row) {
    foreach ($row as $item) {
        echo $item . "&nbsp";
        
        if ($item < 10) {
            echo "&nbsp;&nbsp;";
        }
    }
    
    echo "</br>";
    
}

echo '------------------------------------------------';
echo '<br />';


$sortObj = $factory->getSort("VerticalSortClass");
$a = $sortObj->sortArr();
$sortObj->displayArray($a);

$sortObj->flag = true;
$a = $sortObj->sortArr();
$sortObj->displayArray($a);*/


use liw\app\twit\User;


//$a = new User();
//$id = $a->signUp("Mary", "marynka123@gmail.com", "qwerty04");
//echo "<br>$id";

//$b = new User();
//$id = $b->addTwit(1, "bla - bla");
//echo "<br>";

//$c = new User();
//$result = $c->getPost(1);
//print_r($result);

//$d = new User();
//$result = $d ->addFollow(8,4);
//print_r($result);

//$f = new User();
//$result = $f ->delFollow(8,4);
//print_r($result);

//$g = new User();
//$result = $g ->getFollowers(1);
//echo '<pre>';
//print_r($result);

$h = new User();
$result = $h ->getUsers();
echo '<pre>';
print_r($result);
echo '<pre>';


