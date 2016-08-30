<?php

namespace app;
use SplFileInfo;


class DisplayFilesTree {

    protected $handle;
    protected $file;
    protected $info;
    protected $count;

    public function display($path) {

        $this->director($path);
        $this->count++;
        echo "<pre>";
        if ($this->handle = opendir($path)) {
            while (false !== ($this->file = readdir($this->handle))) {
                $this->sp();
                $this->info = new SplFileInfo($this->file);
                if ($this->info->getExtension() == TRUE) {
                    echo $this->file . " (file) <pre>";
                } elseif ($this->file == '..' || $this->file == '.') {
//                    echo $this->file . "<pre>";
                } elseif ($this->info->getExtension() == FALSE) {
                    echo $this->file . "\<pre>";
                }
            }
        closedir($this->handle);
        }
    }

    public function sp() {
        for ($j = 0; $j < $this->count; $j++) {
            echo "  ";
        }
    }

    public function director($path) {
        $directory = explode("/",  $path);
        $this->count = 0;
        foreach ($directory as $direc) {
            echo $direc . "/<pre>";
            $this->count++;
            $this->sp();
        }
    }
}
