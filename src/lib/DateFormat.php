<?php

namespace App\lib;

use DateTime;

class DateFormat
{

    public static function dateSanitizer($timestamp): string
    {
        $date = new DateTime($timestamp);

        return 'Publié le : ' . $date->format('d-m-Y') . ' à ' . $date->format('H\Hi');
    }
}
