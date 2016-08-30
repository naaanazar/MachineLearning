<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'S3.php';

$storage = new S3;

$upload = $storage->uploadFileToS3 ('S3.php');
echo '<a href='. $upload .'>'. $upload.'</a>';

$list = $storage->listFileFromS3();
var_dump($list);

//$delete = $storage->deleteFileFromS3 ('.php');
//echo $delete . 'delete';
