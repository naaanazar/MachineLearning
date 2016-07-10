<html>
    <head>
        <title>Arrays</title>
    </head>
    <body>
        <form method="post">
            <p>Enter a number from 2 to 10: </p>
            <input type="number" min="2" max="10" name="number" required>
            <input type="submit" name="submit" required>
            <?php
                function Vidstup(){
                    echo '<br>';
                    echo '<br>';
                };
                function OutPutArray($array, $number)
                {
                    for ($i = 0; $i < $number; $i++) { 
                        echo '<br>';
                        for ($j = 0; $j < $number; $j++) { 
                            OutPut($array[$i][$j]);
                        };
                    };
                };
                function OutPut($value)
                {   
                    if($value < 10)
                        echo $value.str_repeat('&nbsp;', 3);
                    else
                        echo $value.str_repeat('&nbsp;', 1);
                };

                function ArrayInit($number)
                {
                    $array = array();
                    for ($i = 0; $i < $number; $i++) { 
                        $array[$i] = array();
                    };
                    return $array;
                };

                if (isset($_POST['number']) && isset($_POST['submit'])) {
                    $number = $_POST['number'];
                    $count = 1;
                    $arrayFinal = ArrayInit($number);
                    for ($i = 0; $i < $number; $i++) { 
                        for ($j = 0; $j < $number; $j++) { 
                            $arrayFinal[$i][$j] = $count;
                            $count++;
                        };
                    };
                    OutPutArray($arrayFinal, $number);
                    Vidstup();
                    for ($j = 0; $j < $number; $j++) { 
                        echo '<br>';
                        for ($i = 0; $i < $number; $i++) { 
                            OutPut($arrayFinal[$i][$j]);
                        };
                    };
                    Vidstup();
                    for ($j = $number - 1; $j >= 0; $j--) { 
                        echo '<br>';
                        for ($i = $number - 1; $i >= 0; $i--) { 
                            OutPut($arrayFinal[$i][$j]);
                        };
                    };
                    Vidstup();
                    for ($i = 0; $i < $number; $i++) { 
                        echo '<br>';
                        if ($i % 2 == 0){
                            for ($j = 0; $j < $number; $j++) { 
                                OutPut($arrayFinal[$i][$j]);
                            };
                        } else { 
                                for ($j = $number - 1; $j >= 0; $j--) { 
                                    OutPut($arrayFinal[$i][$j]);
                            };
                        };
                    };
                    Vidstup();
                    $arraySpiral = ArrayInit($number);
                    $count1 = 1;
                    $i = $j = 0;
                    $right = $number - 1;
                    $left = 0;
                    for ($n = 0; $n < $number * $number; ++$n) {
                        $arraySpiral[$i][$j] = $count1++;
                        if (($i == ($left + 1)) && ($j == $left)) { 
                            $right--;
                            $left++;
                        } 
                        if (($j == $right) && ($i < $right)) { 
                            $i++;
                            continue;
                        } 
                        if (($j < $right) && ($i == $left)) {
                            $j++; 
                            continue;
                        } 
                        if (($i == $right) && ($j > $left)) { 
                            $j--;
                            continue;
                        } 
                        if (($j == $left) && ($i > $left)) {
                            $i--; 
                            continue;} 
                    };
                    OutPutArray($arraySpiral, $number);
                    Vidstup();
                    $antiSpiral = ArrayInit($number);
                    $count2 = $number * $number;
                    $i = $j = 0;
                    $right = $number - 1;
                    $left = 0;
                    for ($n = 0; $n < $number * $number; ++$n) {
                        $antiSpiral[$i][$j] = $count2--;
                        if (($i == ($left + 1)) && ($j == $left)) { 
                            $right--;
                            $left++;
                        } 
                        if (($j == $right) && ($i < $right)) { 
                            $i++;
                            continue;
                        } 
                        if (($j < $right) && ($i == $left)) {
                            $j++; 
                            continue;
                        } 
                        if (($i == $right) && ($j > $left)) { 
                            $j--;
                            continue;
                        } 
                        if (($j == $left) && ($i > $left)) {
                            $i--; 
                            continue;} 
                    };
                    OutPutArray($antiSpiral, $number);
                };
                
            ?>
        </form>
    </body>
</html>


            
        