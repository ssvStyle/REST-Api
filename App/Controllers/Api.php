<?php

namespace App\Controllers;

use Core\BaseController;

class Api extends BaseController
{
    public function getAll()
    {
        /**
         * PUT method dev
         */
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        $content = file_get_contents('php://input');
        $headers = getallheaders();


        $put = [];
        $content = preg_replace('/((----------------------------[a-zA-Z0-9]*)Content-Disposition: form-data; name=")|(----------------------------[a-zA-Z0-9]*--)|[\r\n]*/', '', $content);
        $content = preg_replace('/((----------------------------[a-zA-Z0-9]*)Content-Disposition: form-data; name=")|(----------------------------[a-zA-Z0-9]*--)/', '*', $content);
        $arr = explode('*', $content);
        unset($arr[0]);
        foreach ($arr as $value){
            preg_match('/.*(?=")/', $value, $key);
            preg_match('/(?<=").*/', $value,$newValue);
            $put[$key[0]] = $newValue[0];
        }

        echo json_encode([
            'success' => false,
            'req' => filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_ENCODED),
            'get' => $_GET,
            'post' => $_POST,
            'put' => $put,
            'headers' => $headers,
        ]);

    }

}