<?php

namespace App\Controllers\PUT;
use App\Models\DataValidation;
use App\Models\GetPutData;
use Core\BaseController;

/**
 * Class EditData
 *
 * request PUT
 *
 * Controller for update data
 *
 * @package App\Controllers\PUT
 */
class EditData extends BaseController
{

    public function update()
    {
        $edit  = new \App\Models\ServiceFacade\Save\Update(new DataValidation(GetPutData::fromPhpInput()));
        return $edit->checkAndSave();
    }

}