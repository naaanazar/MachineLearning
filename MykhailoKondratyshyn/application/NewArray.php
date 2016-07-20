<?php

namespace dregan\application;
use dregan\database\Db;
/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 11.07.16
 * Time: 23:14
 */



abstract class NewArray
{
    protected $arrayNew;
    private $db = null;
    abstract function sortArray();

    public function __construct($size)
    {
        $this->db = Db::getInstance();


        $z = 1;
        for ($i = 0; $i <= $size - 1; $i++) {
            for ($j = 0; $j <= $size - 1; $j++) {
                $this->arrayNew[$i][$j] = $z++;
            }
        }
    }







    public function echoArray()
    {
        $arraySorted = $this->sortArray();
        for ($i = 0; $i <= count($this->arrayNew) - 1; $i++) {
            for ($j = 0; $j <= count($this->arrayNew) - 1; $j++) {

                echo $arraySorted[$i][$j] . " ";

            }
            echo "<br>";
        }

        echo "<pre>";
        return $arraySorted;
    }




        public function goMysql($type)
    {
        $arraySorted = $this->sortArray();
        $deviceIds = array();
        for ($m = 0; $m <= count($this->arrayNew) - 1; $m++) {
            for ($h = 0; $h <= count($this->arrayNew) - 1; $h++) {

                $deviceIds[] = $arraySorted[$m][$h];

            }
        }
        $str = implode(',', $deviceIds);

        $strr = json_encode($arraySorted);

        echo '<br>';
        echo json_encode($arraySorted);
        echo '<br>';


        $result = $this->db->query("INSERT INTO `arraysort`(`type`, `result`) VALUES ('$type', '$strr')");

        //return $result->fetchAll(PDO::FETCH_ASSOC);


        $downloadresult = $this->db->query("SELECT result FROM `arraysort` WHERE type = '$type';");


    }








}