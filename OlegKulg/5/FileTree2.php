<?php

class FileTree2
{
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
}
