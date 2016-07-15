<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use sa\app\FactoryArray;
use sa\app\NewArray;
use sa\app\ArrayOut;
use sa\app\view\View;

$newArray = new NewArray;

if (isset($_POST['w1']) && isset($_POST['h1'])) {
    $array = $newArray->crArray($_POST['h1'], $_POST['w1'], $_POST['type']);
} else {
    $array = $newArray::$array;
}

ob_start();

$arrayOut = new ArrayOut;

// autoload classes to factory

foreach (glob("../app/sorters/*Sort.php") as $filename) {
    $className = substr(strrchr($filename, '/'), 1, -4);

    if (method_exists('sa\app\sorters\\' . $className, 'addToFactoryArray')) {
        $fullClassName = 'sa\app\sorters\\' . $className;
        $obj = new $fullClassName;

        if ($obj->addToFactoryArray() === true) {
            $sorter = FactoryArray::getClass($className);

            $sorter->setOrder('ASC');
            $arrayOut->arrayOut($sorter->sort());

            $sorter->setOrder('DESC');
            $arrayOut->arrayOut($sorter->sort());
        }

        unset($obj);
    }         
}

$out = ob_get_contents();
ob_end_clean();

View::$out = $out;
echo View::getHtml();

//$arrayOut->writeToFile($out."<br><a href='../index.php'>back to index.php</a>");

