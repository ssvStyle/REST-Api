<?php

namespace App\Controllers;

use Core\BaseController;

class Home extends BaseController
{

    public function index()
    {

        echo json_encode(['base' => 'first']);

    }


}