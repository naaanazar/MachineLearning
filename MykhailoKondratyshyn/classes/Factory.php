<?php
class MyArray
{
    private $arrayNew;


    public function __construct($size)
    {
        $this->sizeArr = $size;

    }

    public function get_array()
    {
        $arraySorted = array();

        for ($i = 0; $i <= count($this->arrayNew) - 1; $i++) {
            for ($j = 0; $j <= count($this->arrayNew) - 1; $j++) {
                $arraySorted[$j][$i] = $this->arrayNew[$i][$j];

            }
        }


        for ($i = 0; $i <= count($this->arrayNew) - 1; $i++) {
            for ($j = 0; $j <= count($this->arrayNew) - 1; $j++) {

                echo $arraySorted[$i][$j] . " ";

            }
            echo "<br>";

        }


        echo "<pre>";

    }
}

class ArrayFactory
{
    protected $arrayNew;
    public static function create($size)
    {

        $z = 1;
        for ($i = 0; $i <= $size; $i++) {
            for ($j = 0; $j <= $size; $j++) {
                $this->arrayNew[$i][$j] = $z++;
            }
        }

        return new ArrayFactory($size);
    }
}


$arr = ArrayFactory::create(5);

print_r($arr->get_array());