<?php

class Bootstrap {

    public function __construct() {
        setlocale(LC_ALL, 'en_US');
        date_default_timezone_set('Europe/Berlin');

        error_reporting(E_ALL | E_STRICT);

        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);

        include __DIR__ . '/../vendor/autoload.php';
        require_once(__DIR__ . '/TestConfig.php');
        require_once(__DIR__ . '/TestStorage.php');

    }

    public function init() {
    }
}

$bootstrap = new Bootstrap();
$bootstrap->init();
