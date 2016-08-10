<?php

$path = '../';
$queue = '';

function createDir($path = '.')
{
  if ($handle = opendir($path)) {
    echo '<ol class="tree">';

    while (false !== ($file = readdir($handle)))
    {
      if (is_dir($path.$file) && $file != '.' && $file != '..') {
        printSubDir($file, $path, $queue);
      } elseif ($file != '.' && $file != '..') {
        $queue[] = $file;
      }
    }

    printQueue($queue, $path);

    echo "</ol>";
  }
}

function printQueue($queue, $path)
{
  foreach ($queue as $file) {
    printFile($file, $path);
  }
}

function printFile($file, $path)
{
  echo '<li class="file"><a href="' . $path . $file . '">' . $file . '</a></li>';
}

function printSubDir($dir, $path)
{
  echo '<li class="toggle"' . $dir . '<input type="checkbox">';
  createDir($path . $dir . '/');
  echo '</li>';
}

createDir($path);


?>