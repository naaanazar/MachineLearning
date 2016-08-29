<?php

namespace arr\app;
/**
 * Description of Sequence
 *
 * @author Nazar
 */

class Sequence
{
    public $array = [100, 4, 200, 1, 3, 5, 101, 102, 103];
    public $seq = [];

    public function findSequence()
    {
        $best = 0;
        foreach ($this->array as $n) {
            if (!in_array($n-1, $this->array)) {
                $m = $n + 1;
                while (in_array($m, $this->array)) {
                    $m += 1;
                }
                $best = max($best, $m - $n);
            }
        }
                                
        return $best;
    }

}
