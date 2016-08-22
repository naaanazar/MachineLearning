<?php

class FileTree
{
    /**
     *
     * @param string $directory
     * @return array
     */
    public function tree($directory) {
        $fileList = array_flip( scandir($directory) );

        foreach ($fileList as $elementOfList => $value) {
            if ( is_dir($directory . '/' .  $elementOfList) && $elementOfList != '.' && $elementOfList != '..' ) {
                $directoryNextLvl = $directory . '/' .  $elementOfList;
                $fileList[$elementOfList] = $this->tree($directoryNextLvl);
            }
        }
        return $fileList;
    }

    public function tree2($directory) {
        $dir = new \RecursiveDirectoryIterator($directory);
        return new \RecursiveIteratorIterator($dir);
    }

    /**
     *
     * @param array $fileList
     */
    public function treeView($fileList)
    {
        echo '<ul>';

        foreach ($fileList as $elementOfList => $value) {
            echo '<li>' . $elementOfList . '</li>';
            if ( is_array($value) ) {
                $this->treeView($value);
            }
        }

        echo '</ul>';

    }


}
