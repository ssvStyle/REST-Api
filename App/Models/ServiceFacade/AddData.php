<?php

namespace App\Models\ServiceFacade;
use App\Models\ModelsInterfaces\DataValidationInterface;
use Core\Storage\Bases\Mysql;

/**
 * Class AddData
 *
 * add data facade
 *
 * @package App\Models\ServiceFacade
 */
class AddData
{
    /**
     * Validation data obj
     *
     * @var $validData
     */
    private $validData;

    /**
     * data base obj
     *
     * @var $db
     */
    private $db;

    /**
     * AddData constructor.
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
    public function save()
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

            $data = $this->validData->getValidData();
            $sql  = 'INSERT INTO tasks (name, email, job, status_id, admin_edit) 
                                VALUES (\''.$data['name'].'\', \''.$data['email'].'\', \''.$data['job'].'\', \''.$data['status'].'\', 0)';
            $status = $this->db->execute($sql, []);

            return [
                'sucsess' => $status,
            ];
        }

        return $error;
    }




}