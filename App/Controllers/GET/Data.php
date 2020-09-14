<?php

namespace App\Controllers\GET;

use App\Models\DbTxt;
use Core\BaseController;
use Firebase\JWT\JWT;


class Data extends BaseController
{

    public function all()
    {
        //$this->access(false);
        $headers = getallheaders();

        //$token = $headers['token'] ?? '';

        //$decoded = JWT::decode($token, 'example_key', array('HS256'));

        $db = new DbTxt();
        $db->save('data', []);
        return $db->getAll( 'data');

    }

    public function byId()
    {

        $db = new DbTxt();
        return $db->getById( 'data' , (int)$this->data['id']);

    }

    public function byIdField()
    {
        $db = new DbTxt();
        return $db->getByIdField( 'data' , (int)$this->data['id'], (string)$this->data['field']);

    }

}