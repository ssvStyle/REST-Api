<?php

namespace Core;

use App\View;
use Core\Interfaces\BaseController as BaseControllerInterfase;
use App\Models\Authorization as AuthModel;
use App\Models\Db;

abstract class BaseController implements BaseControllerInterfase
{
    /*
     *$data for transfer to all classes of controllers
     */

    public $data;

    /*
     *$view obj for transfer to all classes of controllers
     */

    public $view;

    public function __construct()
    {

        $auth = new AuthModel(new Db());
    }

    /**
     * @param array $data
     */
    public function setData(array $data = [])
    {
        $this->data = $data;
    }

    public function access($bool = true)
    {
        if (!$bool) {
            http_response_code(401);
            exit('Access Denied. You don’t have permission to access for this page <a href="/login">Login</a>');
        }

        return $this;
    }

}