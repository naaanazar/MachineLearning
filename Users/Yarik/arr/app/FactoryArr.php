<?php

namespace Projarr\App;

use Exception;

class FactoryArr {
    
    public $types = array(
        "SortBubble",
        "SortBubbleRew",
        "SortVertical",
        "SortVerticalRew",
    );

    public function getTypes()
    {
        return $this->types;
    }

    public function getArray($type)
    {
        if(in_array($type, $this->types)) {
            $className = 'Projarr\App\\' . $type;
            return new $className();
        } else {
            throw new Exception("Type does not exist");
        }
    }
}