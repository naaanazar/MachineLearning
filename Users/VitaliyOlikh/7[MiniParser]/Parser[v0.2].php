<?php

class Parser
{
    public function parseStr($str)
    {
        $level = 0;

        for ($i = 1; $i <= strlen($str); $i++) {
            if (is_numeric($str[$i])) $matrix[$level][$i] .= $str[$i];
            elseif ($str[$i] === "[") $level++;
            elseif ($str[$i] === "]") $level--;
        }

        return $matrix;
    }

    public function getList($str)
    {
        if ($str[0] === "[") {
            $matrix = $this->parseStr($str);
            foreach ($matrix as $key => $value) {
                echo "<ul><li>Рівень вкладенності: " . $key;
                foreach ($value as  $val) {
                    echo "<ul><li>";
                        echo $val;
                    echo "</li></ul>";
                }
                echo "</li></ul>";
            }
        } elseif (is_numeric($str[0])) {
            echo $str;
        }
    }
}

$str = "[123,[456,[789]],245,[[234]]]";

(new Parser())->getList($str);
