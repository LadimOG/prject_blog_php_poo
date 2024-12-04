<?php

namespace App\lib;

class Server
{

    public static function requestPost()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }
        return true;
    }

    public static function requestGet()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            return;
        }
        return true;
    }
}
