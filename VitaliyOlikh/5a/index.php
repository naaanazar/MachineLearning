<?php

class DirectoryTree
{

    public function createDirectory($dir)
    {
        $cleanPath = realpath($dir) . DIRECTORY_SEPARATOR;
        $scanDir = scandir($cleanPath);

        echo "<ul>";
            foreach ($scanDir as $file) {
                if ($file == "." || $file == "..") {
                    continue;
                }

                echo "<li>";
                    echo $file;
                    if (is_dir($cleanPath . $file) && is_readable($cleanPath . $file)) {
                        $this->createDirectory($cleanPath . $file);
                    }
                echo "</li>";
            }
        echo "</ul>";

    }
}

(new DirectoryTree())->createDirectory("E:/Programing/");