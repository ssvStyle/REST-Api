<?php

namespace App\Controllers\POST;

use Core\BaseController;
use App\Models\Services\AuthService;

class Auth extends BaseController
{

    public function login()
    {

        $headers = getallheaders();

        $authService = new AuthService();

        return $authService->set($_POST);
    }

}