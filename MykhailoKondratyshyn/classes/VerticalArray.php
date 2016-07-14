<?php

/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 11.07.16
 * Time: 23:43
 */
class VerticalArray extends  NewArray
{
   public function verticalArray()
   {
      $k = 6;
      $p = 7;


      $j = $p * $k;


      for ($i = 1; $i <= $k; $i++) {

         foreach (range($i, $j, $k) as $number) {
            echo "$number ";

         }
         echo "<br>";

         $j = $j + 1;

      }
   }
}