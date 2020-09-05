<?php

namespace App\Controllers;

use Core\BaseController;

class Api extends BaseController
{
    public function getAll()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        $content = file_get_contents('php://input');
        $headers = getallheaders();


        preg_match_all('/(?<=Content-Disposition: form-data; name=")[\w]*(?<!-)*/', $content, $put);
        //var_dump($put);

        echo json_encode([
            'success' => false,
            'req' => filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_ENCODED),
            'get' => $_GET,
            'post' => $_POST,
            'put' => $put,
            //'headers' => $headers,
        ]);

    }

}