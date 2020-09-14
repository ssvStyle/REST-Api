<?php

namespace Core\Storage;

use Bases\Mysql;

class CreateMysql extends Storage
{
    public function get()
    {
        return new Mysql();
    }
}