<?php

namespace Core;

use App\Controllers\Home;

/**
 * Class FrontController
 *
 * @package Core
 */
class FrontController
{

    /**
     *
     *
     */
    public function run()
    {

        $router = new Router( $_SERVER['REQUEST_URI'] );

        $response = $router->response();

        if ($response){

            $parseCtrlAtMethod = new ParseCtrlAndMethodName($response['ctrlAtMethod']);


            $controllerName = 'App\Controllers\\'. $parseCtrlAtMethod->getCtrl();
            $methodName = $parseCtrlAtMethod->getMethod();

            $controller = new $controllerName;

            $controller->setData($response['args']);

            $controller->access()->$methodName();


        } else {

            header("HTTP/1.0 404 Not Found");
            http_response_code(404);

        }

    }

}