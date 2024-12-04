<?php

namespace App\lib;

require '../src/config.php';

use PDO;

class ConnectDb
{

    private static ?PDO $pdo = null;


    public static function getConnect(): PDO
    {
        try {
            if (self::$pdo === null) {
                self::$pdo = new PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC

                    ]
                );
            }
            return self::$pdo;
        } catch (\PDOException $e) {
            echo ("Erreur de connexion : " . $e->getMessage());
        }
    }
}
