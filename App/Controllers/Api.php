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

        /**
         *
         *get data from the (PUT) request
         *
         * $input
         */
        $input = file_get_contents('php://input');

        /**
         *
         *get all headers from the (PUT) request
         *
         * $headers
         */
        $headers = getallheaders();

        /**
         *
         *empty var $put for sanitize data
         *
         * $put
         */
        $put = [];
        /**
         *
         *remove all \r\n
         *
         */
        $input = preg_replace('/[\r\n]*/', '', $input);
        /**
         *
         *delete all technical information
         *
         */
        $input = preg_replace('/((-*[a-zA-Z0-9]*)Content-Disposition: form-data; name=")|(--------------------------[a-zA-Z0-9]*--)/u', '-|-', $input);
        /**
         *explode string to array by del -|-
         *
         */
        $arr = explode('-|-', $input);
        /**
         *
         *del from arr empty fields
         *
         */
        $arr = array_diff($arr, ['', NULL, false]);
        /**
         *
         *collecting a clean data array
         *
         */
        foreach ($arr as $value){
            preg_match('/^[a-zA-Z0-9-_]*(?="{1})/u', $value, $key);
            preg_match('/(?<="{1}).*/u', $value,$newValue);
            $put[$key[0]] = $newValue[0];
        }

        echo json_encode([
            'success' => false,
            'req' => filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_ENCODED),
            'get' => $_GET,
            'post' => $_POST,
            'put' => $put,
            'headers' => $headers,
        ], JSON_UNESCAPED_UNICODE);

    }

}