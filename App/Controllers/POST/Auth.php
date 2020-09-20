<?php

namespace App\Controllers\POST;

use App\Controllers\AccessController;
use Core\BaseController;
use App\Models\ServiceFacade\Auth as AuthFacade;

class Auth extends AccessController
{

    public function login()
    {
        $this->access(true);

        $authFacade = new AuthFacade();
        return $authFacade->getToken($_POST);
    }

}