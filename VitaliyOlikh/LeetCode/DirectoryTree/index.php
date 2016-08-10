<?php
function dirToArray($dir) {
    $contents = array();
    foreach (scandir($dir) as $node) {
        if ($node == '.' || $node == '..') continue;
        if (is_dir($dir . '/' . $node)) {
            $contents[$node] = dirToArray($dir . '/' . $node);
        } else {
            $contents[] = $node;
        }
    }
    return $contents;
}

$r = dirToArray('E:/Programing/test');
echo '<pre>';
var_dump($r);