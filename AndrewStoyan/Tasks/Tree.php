<?php

$main = $argv[1];
echo basename($main) . "\n";
$counterSpace = 0;
$dirContent = scandir($main);



for ($i = 0, $n = count($dirContent); $i < $n; $i++) {
    if ($dirContent[$i] != "." && $dirContent[$i] != "..") {
        if (!is_file($main . $dirContent[$i])) {
            echo  str_repeat(" ", $counterSpace);
            echo "|_";
            echo $dirContent[$i] . " (dir)\n";
            $path = $main . $dirContent[$i] . "/";
            dirScan($path, $counterSpace);
        } else {
            echo  str_repeat(" ", $counterSpace);
            echo "|_";
            echo $dirContent[$i] . " (file)\n";
        } 
    } 
}

function dirScan($path, $counterSpace)
{
    $counterSpace++;
    $dirContent1 = scandir($path);
    for ($i = 0, $n = count($dirContent1); $i < $n; $i++) {
        if ($dirContent1[$i] != "." && $dirContent1[$i] != "..") {
            if (!is_file($path . $dirContent1[$i])) {
                echo  str_repeat(" ", $counterSpace);
                echo "|_";
                echo $dirContent1[$i] . " (dir)\n";
                $path1 = $path . $dirContent1[$i] . "/";
                dirScan($path1, $counterSpace);
            } else {
                echo  str_repeat(" ", $counterSpace);
                echo "|_";
                echo $dirContent1[$i] . " (file)\n";
            }
        } 
    }
}

