<?php

namespace App\Exceptions;

use Exception;

class ExceptionPost extends Exception
{

    public function __construct($msg)
    {
        parent::__construct($msg);
    }
}
