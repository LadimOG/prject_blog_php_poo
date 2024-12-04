<?php

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'blog');
define('DB_USER', 'ladim');
define('DB_PASS', 'password');

define('DEBUG', true);
if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}


define('BASE_URL', 'http://localhost:8000');
define('APP_PATH', dirname(__DIR__) . '/');
