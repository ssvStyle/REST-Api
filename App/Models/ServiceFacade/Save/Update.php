<?php

namespace App\Models\ServiceFacade\Save;
/**
 * Class Update
 *
 * @package App\Models\ServiceFacade\Save
 */
class Update extends AddData
{
    /**
     * update data
     *
     * @return boolean (save status)
     */
    public function save():bool
    {
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

            return $this->db->execute($sql, $forUpdate);
    }

}