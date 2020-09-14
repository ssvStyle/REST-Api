<?php

namespace App\Controllers\GET;

use App\Models\Services\GetData;
use Core\BaseController;
use Firebase\JWT\JWT;


class Data extends BaseController
{
    protected $dataFacade;

    public function __construct()
    {
        parent::__construct();
        $this->dataFacade = new GetData();
    }

    public function all()
    {
        return $this->dataFacade->all();
    }

    public function byId()
    {
        return $this->dataFacade->byId((int)$this->data['id']);
    }

    public function byIdField()
    {
        return $this->dataFacade->byIdAndField((int)$this->data['id'], (string)$this->data['field']);
    }

}