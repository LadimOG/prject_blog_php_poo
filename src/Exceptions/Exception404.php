<?php

namespace App\Exceptions;

use Exception;

class Exception404 extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
