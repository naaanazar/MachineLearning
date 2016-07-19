<?php

namespace liw\traits;

trait GoodBye
{
    public function by()
    {
        echo "Good bye!";
    }

    public function boot()
    {
        echo "Boot " . get_called_class();
    }

}
