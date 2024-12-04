<?php

namespace App\lib;


class SanitizerString
{

    public static function secureShowOutput($output): string
    {
        $outputSanitizer = ucfirst(htmlspecialchars($output));
        return $outputSanitizer;
    }

    public static function upperString($output): string
    {
        $outputToUpper = strtoupper(htmlspecialchars($output));

        return $outputToUpper;
    }
}
