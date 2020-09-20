<?php

namespace Core;

use App\View;
use Core\Interfaces\BaseController as BaseControllerInterfase;
use App\Models\Authorization as AuthModel;
use Core\Storage\Bases\Mysql as Db;

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

    abstract public function access($bool = null);
}