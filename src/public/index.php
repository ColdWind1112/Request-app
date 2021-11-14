<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../includes/autoload.php';


if (!is_readable('../.env')) {
    throw new \RuntimeException(sprintf('%s file missing', '.env'));
}

$lines = file('../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {

    if (strpos(trim($line), '#') === 0) {
        continue;
    }

    list($name, $value) = explode('=', $line, 2);
    $name = trim($name);
    $value = trim($value);

    if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
        putenv(sprintf('%s=%s', $name, $value));
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}

$urlParts = explode("/", $_SERVER['REQUEST_URI']);

switch ($urlParts[1]) {
    case 'records':
        $record = new Controllers\RecordsController();
        $method = isset($urlParts[2]) ? $urlParts[2] : 'index';
        try {
            if (true === isset($urlParts[3])) {
                $record->{$method}($urlParts[3]);
            } else {
                $record->{$method}();
            }
        } catch (Exception $e) {
            print_r($e);
            die();
        }
        break;
    default:
        echo "404 Error page : wrong page";
        break;
}
