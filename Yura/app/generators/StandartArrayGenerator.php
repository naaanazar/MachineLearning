<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace yu\app\generators;

/**
 * Description of StandartArrayGenerator
 *
 * @author yurii
 */
class StandartArrayGenerator implements BaseArrayGenerator
{
    public static function generate()
    {
        return range(1, 100);
    }
}
