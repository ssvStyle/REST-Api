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

            $requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_ENCODED);

            switch (true) {
                case $requestMethod === 'GET' && $parseCtrlAtMethod->getCtrl() === 'Get':
                    $controllerName = 'App\Controllers\Get';
                    break;
                case $requestMethod === 'POST' && $parseCtrlAtMethod->getCtrl() === 'Post':
                    $controllerName = 'App\Controllers\Post';
                    break;
                case $requestMethod === 'PUT' && $parseCtrlAtMethod->getCtrl() === 'Put':
                    $controllerName = 'App\Controllers\Put';
                    break;
                case $requestMethod === 'DELETE' && $parseCtrlAtMethod->getCtrl() === 'Delete':
                    $controllerName = 'App\Controllers\Delete';
                    break;
                default:
                    exit(json_encode(
                        [
                            'success' => false,
                            'error' => 'undefined method'
                        ]
                    ));die;
                    break;
            }

            $methodName = $parseCtrlAtMethod->getMethod();

            $controller = new $controllerName;

            $controller->setData($response['args']);

            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');

            echo json_encode($controller->access()->$methodName(), JSON_UNESCAPED_UNICODE);


        } else {

            header("HTTP/1.0 404 Not Found");
            http_response_code(404);

        }

    }

}