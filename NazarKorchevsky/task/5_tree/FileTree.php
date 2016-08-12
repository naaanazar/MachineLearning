<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class FileTree
{

    public function dirToArray($dir)
    {
        $contents = array();
        $files = @scandir($dir);

        if ($files !== false) {

            foreach ($files as $node) {

                if ($node == '.')  continue;
                if ($node == '..') continue;

                if (is_dir($dir . DIRECTORY_SEPARATOR . $node)) {

                    $node1 =$node .'|' . '(cat)';
                    $contents[$node1] = $this->dirToArray($dir . DIRECTORY_SEPARATOR . $node);
                } else {
                   //size file
                    $size = round(@filesize($dir . DIRECTORY_SEPARATOR . $node)/1024, 2) . 'Kb';
                    $node =$node .'|' . '(file)'. '|' .$size;
                    $contents[] = $node;
                }
            }
            return $contents;
        }
    }

    public function out($arr)
    {
        echo '<ul>';
        foreach($arr as $k=>$val){

            if(is_array($val)){
                echo '<li><b>' .$k . '</b></li>';
                $this->out($val);
            } else {
                echo '<li><i>'.$val . '</i></li>';
            }
        }
        echo '</ul>';
    }

    public function getFileTree($dir)
    {
        echo "<h3>$dir</h3>";
    $contents = $this->dirToArray($dir);
    return $this->out($contents);
    }
}