<?php

namespace App\Models\ModelsInterfaces;

interface DataValidationInterface
{

    public function __construct(array $post);
    public function fieldName();
    public function fieldEmail();
    public function fieldTask();
    public function fieldStatusId();
    public function getValidData();

}