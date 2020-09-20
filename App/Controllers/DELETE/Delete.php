<?php

namespace App\Controllers\DELETE;

use Core\BaseController;

class Delete extends BaseController
{
    public function oneById()
    {
        return [
            'method' => $_SERVER['REQUEST_METHOD'],
            'success' => false,
        ];
    }
}