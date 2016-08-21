<?php

    $factorial = function($number) use(&$factorial) {

        $fact = 1;  

        if($number == 0) {
            return 1;
        }

        while($number > 1) {
            $fact *= $number--;
            $factorial($number);
        }

        return $fact;
    };

    echo $factorial(5);