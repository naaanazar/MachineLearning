<?php

namespace ex\app\api;

interface SortCreator_IP
{
    public function getOriginalArray();
    public function getSort($name, $arrayOriginal);
}