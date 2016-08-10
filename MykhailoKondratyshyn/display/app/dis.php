<?php


class Tree
{
//$dir = '/home/crowdin_share';
    public $br = ":<br>";
    public $ul = "<ul>";
    public $li = "<li>";
    public $unLi = "</li>";
    public $unUl = "</ul>";

    public function display($dir = "../.")
    {
        if (is_dir($dir)) {
            echo $dir, $this->br, $this->ul;
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file == '..' || $file == '.') {
                        continue;
                    }
                    echo $this->li;
                    if (is_dir($dir . "/" . $file)) {
                        $this->display($dir . "/" . $file);
                    } else {
                        echo $file;
                    }
                    echo $this->unLi;
                }
                closedir($dh);
            }
            echo $this->unUl;
        }


    }


    


}