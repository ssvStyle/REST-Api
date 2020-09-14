<?php

namespace Core\Interfaces\Db;

interface DataBaseInterface
{
    public function query($sql, $data = []);

    public function queryRetObj($sql, $data = [], $class);

    public function execute();

    public function getLastInsertId();
}