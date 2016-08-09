<?php


$dir = '/home/crowdin_share';


function display($dir = ".")
{
    if (is_dir($dir)) {
        echo $dir, ":<br><ul>";
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file == '..' || $file == '.') {
                    continue;
                }
                echo "<li>";
                if (is_dir($dir . "/" . $file)) {
                    display($dir . "/" . $file);
                } else {
                    echo $file;
                }
                echo "</li>";
            }
            closedir($dh);
        }
        echo "</ul>";
    }
}

display();
