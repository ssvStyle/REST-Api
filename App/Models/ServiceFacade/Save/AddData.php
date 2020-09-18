<?php

namespace App\Models\ServiceFacade\Save;

use App\Models\ModelsInterfaces\DataValidationInterface;
use Core\Storage\Bases\Mysql;

/**
 * Class AddData
 *
 *
 * @package App\Models\ServiceFacade\Save
 */
abstract class AddData
{
    /**
     * Validation data obj
     *
     * @var $validData
     */
    protected $validData;

    /**
     * data base obj
     *
     * @var $db
     */
    protected $db;

    /**
     * EditData constructor.
     *
     * @param DataValidationInterface $dataValidation
     */
    public function __construct(DataValidationInterface $dataValidation)
    {

        $this->validData = $dataValidation;
        $this->db = new Mysql();

    }

    /**
     * save data if valid === true
     *
     * @return array errors or save status
     */
    public function checkAndSave():array
    {

        $error['errors'] = [];

        if (!$this->validData->fieldName()) {
            $error['errors'][] = 'field name false';
        }

        if (!$this->validData->fieldEmail()) {
            $error['errors'][] = 'field email false';
        }

        if (!$this->validData->fieldStatusId()) {
            $error['errors'][] = 'field status false';
        }

        if (!$this->validData->fieldTask()) {
            $error['errors'][] = 'field task false';
        }

        if (empty($error['errors'])) {


            return [
                'success' => $this->save(),
            ];
        }

        return $error;
    }

    /**
     * insert or update
     *
     * @return bool
     */
    abstract public function save():bool;
}