<?php

class Parser
{
    public function parserString($str)
    {
        $start = strpos($str, "[");
        $end = strrpos($str, "]");
        if (($start < 0 || $start !== false) && ($end < 0 || $end !== false)) {
            $newStr = substr($str, $start + 1, ($end - ($start + 1)));
            $newStr = str_replace("],[" , ",", $newStr);
            $this->getList($newStr);
        }
    }

    public function getList($newStr)
    {
        $start2 = strpos($newStr, "[") === false ? null : strpos($newStr, "[");
        $list = $start2 === null ? substr($newStr, 0) : substr($newStr, 0, $start2);
        echo "<ul><li>";
        echo  $list;
        $this->parserString($newStr);
        echo "</li></ul>";
    }
}

$str = "[123,[456,[789,[245]]]]";

(new Parser())->parserString($str);