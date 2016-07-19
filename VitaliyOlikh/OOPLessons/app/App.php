<?php
namespace liw\app;

use \liw\traits\HelloWorld;
use \liw\traits\GoodBye;


final class App
{
    use HelloWorld, GoodBye {
        HelloWorld::boot insteadof GoodBye;
    }

    public function __construct() {
        $this->helloWorld();
        echo "<br>";
        $this->by();
        echo "<br>";
        $this->boot();
    }

}