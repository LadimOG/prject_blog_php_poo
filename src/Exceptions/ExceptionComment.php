<?php

namespace App\Exceptions;

use Exception;

class ExceptionComment extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
