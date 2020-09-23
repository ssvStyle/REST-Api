<?php

namespace Core;

use App\Controllers\Home;
use Core\Interfaces\RouterInterface;

/**
 * Class FrontController
 *
 * @package Core
 */
class FrontController
{
    /**
     * @var router
     */
    protected $router;

    /**
     * FrontController constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * Run app
     *
     * @return mixed
     */
    public function run()
    {

        $response = $this->router->response();

        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        if ($response){

            $controllerName = 'App\Controllers\\' . ucfirst($response['controller']);
            $methodName = $response['method'];

            $controller = new $controllerName;

            $controller->setData($response['args']);

            echo json_encode($controller->access($response['access'])->$methodName(), JSON_UNESCAPED_UNICODE);

        } else {

            header("HTTP/1.0 404 Not Found");
            http_response_code(404);

        }

    }

}