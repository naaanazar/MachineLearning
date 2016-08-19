<?php
namespace arrays\app\arr;
/**
 *
 * @author dron
 */
use arrays\app\arr\out\OutPut;
use mysqli;
abstract class ArrayBase
{
    public $array;
    private $counter;
    public $position;
    public $type;
    public $number;
    public abstract function Feel();
    public abstract function Display();
    public function ToDB()
    {
        $connection = DataBaseConnect::getInstance()->doConnect();
        if ($connection->connect_errno) {
            die("Hadn`t connected: %s\n" . $connection->connect_errno);
        }

        DataBaseConnect::checkMod($this->type, $this->array, $connection);
    }

    public function FromDB()
    {
        $connection = DataBaseConnect::getInstance()->doConnect();

        $query = "SELECT arr FROM arrays WHERE id = \"$this->type\"";

        $arrFromDB = $connection->query($query)->fetch_array(MYSQLI_ASSOC);
        

        OutPut::OutPutArray(unserialize($arrFromDB["arr"]), $this->number);

    }
}
