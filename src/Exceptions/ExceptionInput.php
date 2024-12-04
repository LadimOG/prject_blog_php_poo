<?php

namespace App\Exceptions;

use Exception;

class ExceptionInput extends Exception
{

    public function __construct($msg)
    {
        parent::__construct($msg);
    }
}
