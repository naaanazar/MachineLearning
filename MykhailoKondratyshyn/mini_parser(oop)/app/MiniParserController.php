<?php

/**
 * Created by PhpStorm.
 * User: space-user-1
 * Date: 23.08.16
 * Time: 11:21
 */
class MiniParserController
{

    protected $str = "[123,[456,[78],[999,[888]],[777]]],[555,[444]]]";
    protected $str2 = "";
    protected $arr = [];

    public function parser()
    {


        $g = 0;
        $h = 0;

        for ($n = 0; $n < strlen($this->str); $n++) {
            if (is_numeric($this->str[$n])) {

                $this->str2 = $this->str2 . $this->str[$n];
                if (!is_numeric($this->str[$n + 1])) {

                    $this->arr[$g][$h] = $this->str2;
                    $this->str2 = '';

                }
            }

            if ($this->str[$n] == "[") {

                $h++;

            }
            if ($this->str[$n] == "]") {

                $h--;
                $g--;

            }
        }
        return $this->arr;
    }


    public function toObject()
    {

        $object = (object)$this->arr;
        echo "<pre>";
        print_r($object);
    }


}