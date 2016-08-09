<?php

namespace ex\app;

use ex\app\Controller;

class Core
{
    function __construct()
    {
        $controller = 'tweet';
        $method = 'login';

        $MvcUrl = explode('/', $_SERVER['REQUEST_URI']);

        if ( !empty($MvcUrl[1]) ) {
            $controller = $MvcUrl[1];
        }

        if ( !empty($MvcUrl[2]) ) {
            $method = $MvcUrl[2];
        }

        $model = ucfirst(mb_strtolower($controller));
		$controller = ucfirst(mb_strtolower($controller));
		$method = mb_strtolower($method);

        $runController = new Controller;
        $runController->setController($controller, $model, $method);
    }
}
