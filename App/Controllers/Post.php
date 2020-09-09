<?php

namespace App\Controllers;

use Core\BaseController;

class Post extends BaseController
{

    public function create()
    {

        return $_POST;

    }

}