<?php
session_start();
$start = microtime(true);

include __DIR__ . '/vendor/autoload.php';

use Core\FrontController;

/**
 * SIMON-LIB
 *
 *
 *
 */


$myApp = new FrontController();

$myApp->run();

if (require __DIR__ . '/config/scriptTime.php') {

    include __DIR__ . '/templates/time.php';

}