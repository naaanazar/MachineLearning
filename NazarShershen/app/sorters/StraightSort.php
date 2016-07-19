<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace arr\app\sorters;

/**
 * Description of StraightSort
 *
 * @author Nazar
 */
class StraightSort extends BaseSort
{
    public function sortArray()
    {
        $this->sortedArray = $this->array;
        return $this->sortedArray;
    }
}
