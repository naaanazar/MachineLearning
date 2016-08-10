<?php

$matrix = array(
    array(1, 0, 1, 1, 1, 1),
    array(1, 0, 1, 1, 1, 1),
    array(1, 1, 1, 1, 1, 1),
    array(1, 0, 0, 1, 0, 0),
    array(1, 0, 0, 1, 0, 0)
);
$globalResult = 0;
$rowSize = count($matrix[0]);
$colSize = count($matrix);

function compareFunction($x1, $y1, $x2, $y2)
{
    $length = $y2 - $y1 + 1;
    $width = $x2 - $x1 + 1;
    $result = 0;
    $matrix1 = $GLOBALS['matrix'];

    for($i = 0; $i < $length; $i++) {
        for($j = 0; $j < $width; $j++) {
            if ($matrix1[$i + $y1][$j + $x1]) {
                $result++;
            }
        }
    }

    if($result == $length * $width && $result > $GLOBALS['globalResult']) {
        $GLOBALS['globalResult'] = $result;
        
    }
}

function bruteforceFunction() {
    $rowSize1 = $GLOBALS['rowSize'];
    $colSize1 = $GLOBALS['colSize'];
    for ($i1 = 0; $i1 < $rowSize1; $i1++) {
        for ($j1 = 0; $j1 < $colSize1; $j1++) {
            for ($i2 = $i1; $i2 < $rowSize1; $i2++) {
                for ($j2 = $j1; $j2 < $colSize1; $j2++) {
                       compareFunction($i1, $j1, $i2, $j2);
                }
            }
        }
    }
    echo "The biggest rectangle has: " . $GLOBALS['globalResult'] . "\n";
}

bruteforceFunction();