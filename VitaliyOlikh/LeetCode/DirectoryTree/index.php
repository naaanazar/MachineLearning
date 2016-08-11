<?php

class PathDirectory
{
  public function createDirectory($path)
  {
    $pathArray = [];

    foreach (scandir($path) as $node) {
      if ($node == '.' || $node == '..') continue;

      if (is_dir($path . '/' . $node)) {
        $pathArray[$node] = $this->createDirectory($path . '/' . $node);
      } else {
        $pathArray[] = $node;
      }
    }
    return $pathArray;
  }

  public function outputDirectory($pathArray)
  {

    for ($i = 1; $i < count($pathArray); $i++) {
      
    }

    return $output;
  }
}

$obj = new PathDirectory();

echo '<pre>';
$pathArray = $obj->createDirectory('E:/Programing/test');
echo $obj->outputDirectory($pathArray);


