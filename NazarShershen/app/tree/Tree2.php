<?php

namespace arr\app\tree;

/**
 * Description of Tree2
 *
 * @author Nazar
 */
class Tree2
{

    public $cnt = 0;
    public $a;
    public $path;

    public function __construct($path)
    {
        $this->path = $path;
        $this->a = substr_count($path, '/');
    }

    public function createIterator() {

        $dir = new \RecursiveDirectoryIterator($this->path);
        return new \RecursiveIteratorIterator($dir);

    }
    
    public function iterateDirectory($iterator) {

        foreach ($iterator as $item) {           

            $this->cnt = substr_count($item, '/');
            $indent = str_repeat("-", $this->cnt - $this->a);

            if ($item->isDir())
            {
                echo $indent.$item."- folder </br>";
                $this->iterateDirectory($item);

            } else {
                echo $indent.$item." - file </br>";
            }            
        }
    }
}
