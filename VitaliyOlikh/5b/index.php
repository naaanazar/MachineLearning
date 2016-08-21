    <?php

class DirectoryTree
{
    public function createDirectory($dir)
    {
        $iterator = new RecursiveIteratorIterator(
                            new RecursiveDirectoryIterator($dir),
                            RecursiveIteratorIterator::SELF_FIRST
                        );

        $this->outputDirectory($iterator);
    }

    public function outputDirectory($iterator)
    {
        foreach ($iterator as $path) {
            if ($path->isDir()) {
                echo $path . "<br>";
            } else {
                echo $path->getFilename() . "<br>";
            }
        }
    }
}

(new DirectoryTree())->createDirectory("E:/Programing/test1/");