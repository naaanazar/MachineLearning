<?php

namespace ex\app;

class View
{
    function generateView($view)
    {
        include '../view/' . $view . '.php';
    }
}
