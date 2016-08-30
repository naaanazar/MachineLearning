<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class NestedIntegersController extends Controller
{
    public $string = "[123,[456,[789,34]]]";
//    public $string = "[123,[456,[78],[999,[888]],[777]]],[555,[444]]]";
//    public $string = "123,124";


    public function index()
    {
        $str = $this->string;
        $str2 = '';
        $i = 0;
        $j = 0;

        if(is_numeric($str)) {
            echo $str;
            return;
        }

        if ($str[0] == '[') {

            for($n = 0; $n < strlen($str); $n++) {

                if(is_numeric($str[$n])) {
                    $str2 = $str2.$str[$n];
                } elseif (($str[$n] == '[' || $str[$n] == ']' || $str[$n] == ',' ) && $str2 != '') {
                    $arr[$i] = $str2;
                    $str2 = '';
                    $i++;
                }
                if ($str[$n] == '[') {
                    $j++;
                    $key[$i] = $j;
                } elseif ($str[$n] == ']') {
                    $j--;
                } elseif ($str[$n] == ',') {
                    $key[$i] = $j;
                }
            }

            for ($n = 0; $n < $i; $n++) {
                for ($q = 0; $q < $key[$n]; $q++) {
                    echo "--";
                }
                echo $arr[$n]."<br>";
            }
            
        } else {

            $arr = explode(',', $str);
            print_r($arr);

        }
    }
}
