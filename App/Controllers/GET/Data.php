<?php

namespace App\Controllers\GET;

use App\Models\ServiceFacade\GetData;
use Core\BaseController;
use Firebase\JWT\JWT;


class Data extends BaseController
{
    protected $getDataFacade;

    public function __construct()
    {
        parent::__construct();
        $this->getDataFacade = new GetData();
    }

    public function all()
    {
        return $this->getDataFacade->all();
    }

    public function byId()
    {
        return $this->getDataFacade->byId((int)$this->data['id']);
    }

    public function byIdField()
    {
        return $this->getDataFacade->byIdAndField((int)$this->data['id'], (string)$this->data['field']);
    }

}