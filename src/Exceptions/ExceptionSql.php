<?php

namespace App\Exceptions;

use Exception;

class ExceptionSql extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
