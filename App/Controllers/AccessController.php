<?php

namespace App\Controllers;

use App\Models\ServiceFacade\Auth as AuthFacade;
use Core\BaseController;

class AccessController extends BaseController
{

    public function access($bool = null)
    {
        $headers = getallheaders();

        $token = $headers['token'] ?? '';

        $auth = new AuthFacade();

        if ($auth->checkToken($token) || $bool === true) {

                return $this;

        }

        header("HTTP/1.0 401 Unauthorized");
        http_response_code(401);
        exit();
    }
}