<?php

class DirectoryTree
{
    public function createDirectory($dir)
    {
        $cleanPath = realpath($dir) . DIRECTORY_SEPARATOR;
        $scanDir = scandir($cleanPath);

        $this->outputDirectory($scanDir, $cleanPath);
    }

    public function outputDirectory($scanDir, $path)
    {
        echo "<ul>";
            foreach ($scanDir as $file) {
                if ($file == "." || $file == "..") {
                    continue;
                }
                echo "<li>";
                    echo $file;
                    if (is_dir($path . $file) && is_readable($path . $file)) {
                        $this->createDirectory($path . $file);
                    }
                echo "</li>";
            }
        echo "</ul>";
    }
}

(new DirectoryTree())->createDirectory("E:/Programing/");