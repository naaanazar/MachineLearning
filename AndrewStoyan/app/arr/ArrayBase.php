<?php
namespace arrays\app\arr;
/**
 *
 * @author dron
 */

abstract class ArrayBase
{
    public $array;
    private $counter;
    public abstract function Feel();
    public abstract function Display();
    public function File() {
        $handle = fopen("../../var/arr.txt", "a");
        $value = serialize($this->array) . "\n";
        fwrite($handle, $value);
        fclose($handle);
    }
}
