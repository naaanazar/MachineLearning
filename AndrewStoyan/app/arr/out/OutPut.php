<?php
namespace arrays\app\arr\out;
    /**
    * Take care about outputing things 
    *
    */
class OutPut 
{
		
    public static function Offset($value)
    {
        echo str_repeat('<br>', $value);
    }

    public static function OutPuts($value)
    {
        if($value < 10) {
            echo $value . str_repeat('&nbsp;', 3);
        } else {
            echo $value . str_repeat('&nbsp;', 1);
        }
    }

    public static function OutPutArray($array, $number)
    {
        for ($i = 0; $i < $number; $i++) { 
            self::Offset(1);
            for ($j = 0; $j < $number; $j++) { 
                self::OutPuts($array[$i][$j]);
            }
        }
        self::Offset(2);
    }

    public static function FromFile($number)
    {
        echo '<br>' . 'From file : ' . '<br>';
        $handle = fopen("../../var/arr.txt", "r");
        while (($buffer = fgets($handle)) !== false) {
            $arr_from_file = unserialize($buffer);
            OutPut::OutPutArray($arr_from_file, $number);
        }
        fclose($handle);
    }
}
