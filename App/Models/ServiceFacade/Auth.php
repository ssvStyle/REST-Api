<?php

namespace App\Models\ServiceFacade;

use App\Models\Authorization;
use Core\Storage\Bases\Mysql;
use Firebase\JWT\JWT;

class Auth
{
    protected $authorization;

    public function __construct()
    {
        $this->authorization = new Authorization(new Mysql());

    }
    public function getToken($post)
    {

        $login = $post['login'] ?? '';
        $pass = $post['pass'] ?? '';




        if ($this->authorization->loginAndPassValidation($login, $pass)) {

            $user = $this->authorization->getUser();

            $key = "example_key";
            $payload = [
                'iss' => 'http://example.org',
                'aud' => 'http://example.com',
                'iat' => time(),
                'exp' => time() + 24*60*60,
                'sub' => 'auth',
                'userId' =>$user['id'],
                'userStatus' =>$user['status'],
            ];

            $jwt = JWT::encode($payload, $key, 'HS256');



            return [
                'success' => true,
                'token' => $jwt,
            ];
        }

        return [
            'success' => false,
        ];
    }

    public function checkToken($token)
    {
        $key = "example_key";
        $res = false;
        try {
            $res = $this->authorization->userVerify(JWT::decode($token, $key, ['HS256']));
        } catch (\Exception $a) {

            //add too log

        } finally {

            return $res;
        }

    }

}