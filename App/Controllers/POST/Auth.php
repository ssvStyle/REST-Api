<?php

namespace App\Controllers\POST;

use Core\BaseController;
use App\Models\ServiceFacade\Auth as AuthFacade;

class Auth extends BaseController
{

    public function login()
    {

        $authFacade = new AuthFacade();

        return $authFacade->set($_POST);
    }

}