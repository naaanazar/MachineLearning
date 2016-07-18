<?php

namespace ex\app;

class Output
{
    private $size;
    private $sortableArray;

    function __construct($size, $sortableArray)
    {
        $this->size = $size;
        $this->sortableArray = $sortableArray;
    }

    public function arrayView()
    {
        echo "<table border='1'>";

        for($i = 0; $i <= $this->size; $i++) {
            echo "<tr>";

            for($i2 = 0; $i2 <= $this->size; $i2++) {
                echo "<td>". $this->sortableArray[$i][$i2] . "</td>";
            }

            echo "</tr>";
        }

        echo "</table><hr /><br />";
    }

    public function printArrayInfile($file)
    {
        $file = '../web/file/' . $file;
        $fp = fopen($file, "a");

        foreach($this->sortableArray as $key1 => $arr1) {
            foreach($arr1 as $key2 => $arr2) {
                $test = fwrite($fp, $arr2."\t");
            }

            $test = fwrite($fp, "\r\n");
        }
        $test = fwrite($fp, "\r\n");
        if ($test) {
            echo 'YES';
            
        }else {
            echo 'ERROR. Pliz create file or get permission';
        }

        fclose($fp);

        echo "<hr />";
    }
}