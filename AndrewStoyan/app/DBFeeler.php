<?php

namespace arrays\app;

/**
 * Description of DBFeeler
 *
 * @author dron
 */
use arrays\app\arr\DataBaseConnect;
class DBFeeler
{
    public function __construct($quantity)
    {
        $type = "";
        $connection = DataBaseConnect::getInstance()->doConnect();
        
        for ($i = 0; $i <= $quantity; $i++) {
            for ($j = 0; $j < 10; $j++) {
                $type .= rand(65, 122);
            }
            $query = "INSERT INTO tutorial_tbl(tutorial_title) VALUES (\"$type\")";
            $connection->query($query);
            $type = '';
            echo "Written" . "<br>";
        }
    }
}
