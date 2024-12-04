<?php

namespace App\lib;

class View
{

    public static function render(string $template, array $data = [])
    {
        extract($data);
        include "../src/views/$template";
    }
}
