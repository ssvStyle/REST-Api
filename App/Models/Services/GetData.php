<?php

namespace App\Models\Services;
use Core\Storage\CreateMysql as Db;

/**
 * Class GetData
 * pattern Facade
 *
 * @package App\Models\Services
 */
class GetData
{
    /**
     * @var $db/PDO
     */
    protected $db;

    /**
     * @var error
     */
    protected $error = ['status' => false, 'error' => 'not found'];

    /**
     * GetData constructor.
     */
    public function __construct()
    {

        $this->db = new Db();

    }

    /**
     * method for return all data from db
     * @return array
     */
    public function all() :array
    {

        $sql = 'SELECT tasks.id, name 
                FROM tasks
                LEFT JOIN status ON tasks.status_id = status.id';

        return $this->db->query($sql, []);
    }

    /**
     * @param integer $id
     *
     * method for return only one data from db
     * @return array
     */
    public function byId(int $id) :array
    {
        $sql = 'SELECT tasks.id, name, email, job, status.status_name as status, admin_edit 
                FROM tasks
                LEFT JOIN status ON tasks.status_id = status.id
                WHERE tasks.id = :id';

        return $this->db->query($sql, [':id' => $id])[0] ?? $this->error;
    }

    /**
     * @param integer $id
     * @param string $field
     *
     * method for return only one field from db by id
     *
     * @return array
     */

    public function byIdAndField(int $id, string $field) :array
    {

        switch ($field){
            case 'id':
                $sqlField = 'tasks.id';
                break;
            case 'name':
                $sqlField = 'name';
                break;
            case 'email':
                $sqlField = 'email';
                break;
            case 'task':
                $sqlField = 'job';
                break;
            case 'status':
                $sqlField = 'status.status_name as status';
                break;
            case 'adminEdit':
                $sqlField = 'admin_edit';
                break;
            default:
                return $this->error;
        }

        $sql = 'SELECT '.$sqlField.'
                FROM tasks
                LEFT JOIN status ON tasks.status_id = status.id
                WHERE tasks.id = :id';

        return $this->db->query($sql, [':id' => $id])[0] ?? $this->error;
    }

}