<?php

namespace Core\Storage;

use Core\Interfaces\Db\DataBaseInterface;

abstract class Storage
{
    abstract public function get():DataBaseInterface;
}