<?php

namespace App\Controllers\POST;
use App\Models\DataValidation;
use App\Models\ServiceFacade\AddData;
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
class NewData extends BaseController
{
    /**
     * @return array
     */
    public function add()
    {

        $addDataFacade = new AddData(new DataValidation($_POST));
        return $addDataFacade->save();

    }

}