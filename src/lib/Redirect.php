<?php

namespace App\lib;

class Redirect
{

    public static function to($path): void
    {
        header("Location: {$path}");
        exit;
    }
}
