<?php

namespace App\Models\Services;

use Firebase\JWT\JWT;

class AuthService
{

    public function set($post)
    {

        if ($post['login'] === 'ssv' && $post['pass'] == 123) {

            $key = "example_key";
            $payload = array(
                "iss" => "http://example.org",
                "aud" => "http://example.com",
                "iat" => 1356999524,
                "nbf" => 1357000000
            );

            $jwt = JWT::encode($payload, $key);

            $decoded = JWT::decode($jwt, $key, array('HS256'));

            return [
                'success' => true,
                'token' => $jwt,
                'decoded' => $decoded,
            ];
        }

        return [
            'success' => false,
        ];

    }

}