<?php

namespace App\Models\ServiceFacade\Save;

/**
 * Class AddData
 *
 * add data facade
 *
 * @package App\Models\ServiceFacade
 */
class Insert extends AddData
{
    /**
     * insert data
     *
     * @return boolean (save status)
     */
    public function save():bool
    {
            $data = $this->validData->getValidData();
            $sql  = 'INSERT INTO tasks (name, email, job, status_id, admin_edit) 
                                VALUES (\''.$data['name'].'\', \''.$data['email'].'\', \''.$data['job'].'\', \''.$data['status'].'\', 0)';

        return $this->db->execute($sql, []);
    }

}