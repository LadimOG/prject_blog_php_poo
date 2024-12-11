<?php

namespace App\lib;


class SanitizerString
{

    public static function secureShowOutput($data): string
    {
        $outputSanitizer = ucfirst(htmlspecialchars($data));
        return $outputSanitizer;
    }

    public static function upperString($data): string
    {
        $outputToUpper = strtoupper(htmlspecialchars($data));

        return $outputToUpper;
    }
}
