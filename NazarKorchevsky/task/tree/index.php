<?php
$flag = true;
$dir    = '/home/nazar';
$files = scandir($dir);

while ($flag) {
$flag = false;

    foreach ($files as $key => $value) {
        
        echo $value . "<br>";

        if (is_dir($dir . $value) and $value !== "." and $value !== "..") {
            $file = scandir($dir . $value);
            foreach ($file as $key => $value) {
                echo "&nbsp;&nbsp;". $value . "<br>";
                $flag = true;
            }
        
        }
    }
}
?>