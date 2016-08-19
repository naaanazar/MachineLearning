<?php

namespace ex\app;

class Controller
{
    public $model;
    protected $view;
    public $controller;

    public function __construct()
    {
        $this->view = new View();
    }

    public function setController($controller, $model, $method)
    {
        $controller = '\\ex\\controller\\' . $controller;

        $this->controller = new $controller;
        $this->controller->$method();

        $this->view->generateView($method);
    }

}
