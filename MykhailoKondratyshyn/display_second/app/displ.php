<?php


class Display
{
    public function tree($cwd = "/home/crowdin_share")

    {
        //$root = '../';

        $dir = new RecursiveDirectoryIterator($cwd);
        $iter = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iter as $file) {
            echo "<pre>";
            if ($file->isDir()) {
                echo $file->getPathname();
            } else {

                echo "  This is file    " . $file->getPathname();
            }
        }
        $iter->next();
    }

}

