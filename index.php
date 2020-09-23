<?php

include __DIR__ . '/vendor/autoload.php';

use Core\FrontController;
use Core\Router;


/**
 * SIMON-LIB
 *
 *
 *
 */


$myApp = new FrontController(new Router(  $_SERVER['REQUEST_URI'] ));

$myApp->run();