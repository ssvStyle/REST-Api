<?php

namespace App\Models;

use Core\Storage\Bases\Mysql as db;
use Core\Interfaces\Db\DataBaseInterface;

class Authorization
{
    protected $db;
    protected $login;
    protected $pass;
    protected $hash;
    protected $user;

    /**
     * AuthService constructor.
     * @param \App\Models\Db $db
     *
     */
    public function __construct(DataBaseInterface $db)
    {
            $this->db = $db;

    }

    /**
     * @param $hash
     * 
     * @return bool
     */
    public function userVerify(object $userTokenData)
    {

        if ($userTokenData) {

            $sql = 'SELECT * FROM users WHERE id=:id';

            if ($this->db->query($sql, [
                ':id' => $userTokenData->userId,
                ])[0]) {

                return true;

            }
        }

        return false;
        
    }

    /**
     * @param $status
     *
     * @return bool
     */

    public function userStatusVerify($status = '')
    {
        if ($this->userVerify()) {

            $hash = $_SESSION['UserHash'];

            $sql = 'SELECT status FROM users
                    LEFT JOIN usersStatus ON users.status_id=usersStatus.id WHERE sessionHash=:hash AND status=:status';

            $rez = $this->db->query($sql, [':hash' => $hash, ':status' => $status])[0]['status'] ?? false;

            if ($status === $rez) {

                return true;

            }
        }

        return false;

    }

    /**
     * @param $login
     * 
     * @return bool
     */
    public function loginExist($login)
    {

        $sql = 'SELECT * FROM users WHERE login=:login';

        if($this->db->query($sql, [':login' => $login])) {

            return true;

        }
        return false;
        
    }

    /**
     * @param $login
     * @param $pass
     *
     * @return bool
     */

    public function loginAndPassValidation($login, $pass)
    {
        if ($this->loginExist($login)) {

            $sql = 'SELECT users.id, login, pass, hash, usersStatus.status FROM users
                    LEFT JOIN usersStatus ON users.status_id=usersStatus.id
                    WHERE login=:login';
            $user = $this->db->query($sql, [':login' => $login])[0] ?? false;

            if ($user && password_verify($pass, $user['pass'])) {
                $this->user['id'] = $user['id'];
                $this->user['status'] = $user['status'];

                return true;
            }

        }
        return false;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return bool
     */
    public function setAuth($cookie = false)
    {
        $hash = sha1(microtime() . rand(0, 1000000000));

        $sql = 'UPDATE users SET sessionHash=:hash WHERE id=:id';

        if ($this->db->execute($sql, [':hash'=> $hash, ':id' => $this->user->getId()])) {

            $_SESSION['UserHash'] = $hash;

            if ($cookie) {

                setcookie("UserHash", $hash, time() + 3600, '/');
            }

            return true;
        }
    }

    /**
     * @return bool
     */
    public function exitAuth()
    {
        $hashSession = $_SESSION['UserHash'] ?? null;

        $sql = 'UPDATE users SET sessionHash=:hash WHERE sessionHash=:hashSession';

        if ($this->db->execute($sql, [':hash'=> '', ':hashSession' => $hashSession])) {

            unset($_SESSION['UserHash']);
            setcookie("UserHash", "", time() - 3600*60, '/');
            session_regenerate_id(true);
            return true;

        }
    }



}