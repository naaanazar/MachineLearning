<?php

namespace arr\app\tree;

/**
 * Description of Tree
 *
 * @author Nazar
 */
class Tree
{

    public $originalPath;

    public $displayTree = '';

    public $tree = [];

    public function __construct($path)
    {
        $this->originalPath = $path;
    }

    public function buidTree($path = NULL)
    {

        if($path == NULL) {
            $path = $this->originalPath;
        }

        $this->displayTree .= "<li>". $path ."</li>";
        $this->displayTree .= "<ul>";

        if($dir = opendir($path)) {

            while ( ($item = readdir($dir) ) !== false ) {
                
                if(in_array($item, array('.', '..'))) {
                    continue;
                }

                if(is_dir($path.$item)) {
                    $this->displayTree .= "<li>" .$this->buidTree($path.$item). "</li>";
                }
                $this->displayTree .= "<li>$item</li>";

            }
            closedir($dir);

        }

        $this->displayTree .= "</ul>";
        
        return $this->displayTree;
    }
}
        