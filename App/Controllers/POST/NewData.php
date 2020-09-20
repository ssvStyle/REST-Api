<?php

namespace App\Controllers\POST;
use App\Controllers\AccessController;
use App\Models\DataValidation;
use App\Models\ServiceFacade\Save\Insert;
use Core\BaseController;

/**
 * Class NewData
 *
 * request POST
 *
 * Controller for add new data
 *
 * @package App\Controllers\POST
 */
class NewData extends AccessController
{
    /**
     * @return array
     */
    public function add()
    {

        $addDataFacade = new Insert(new DataValidation($_POST));
        return $addDataFacade->checkAndSave();

    }

}