<?php

namespace App\Models\ServiceFacade;
use App\Models\ModelsInterfaces\DataValidationInterface;
use Core\Storage\Bases\Mysql;

/**
 * Class EditData
 *
 * EditData facade
 *
 * @package App\Models\ServiceFacade
 */
class EditData
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
            $sql  = 'UPDATE tasks SET name=:name, email=:email, job=:job, status_id=:status, admin_edit=:adminEdit  WHERE id=:id';

            $forUpdate = [
                ':name' => $data['name'],
                ':email' => $data['email'],
                ':job' => $data['job'],
                ':status' => $data['status'],
                ':adminEdit' => true,
                ':id' => (int)$data['id'],
            ];
            //$status = $this->db->execute($sql, $forUpdate);
            return [
                'success' => $status,
            ];
        }

        //return $data;
        return $error;
    }




}