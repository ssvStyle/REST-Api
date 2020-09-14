<?php

namespace App\Models;


class DbTxt
{
    protected $data = __DIR__ . '/../../dbTxt/data.db';
    protected $user = __DIR__ . '/../../dbTxt/user.db';
    protected $token = __DIR__ . '/../../dbTxt/token.db';

    public function save(string $db, array $data)
    {
        $data['id'] = $this->getMaxId($db)+1;
        $toBeSaved = serialize($data);

        file_put_contents($this->$db, $toBeSaved . PHP_EOL, FILE_APPEND);

    }

    public function getAll(string $db): array
    {

        $result = [];

        $fp = fopen($this->$db,'rb');

        while(!feof($fp)) {
            $current_line = fgets($fp);

            $result[] = unserialize($current_line);

        }

        fclose($fp);

        return $result;

    }

    public function getById(string $db, int $id): array
    {

        $fp = fopen($this->$db,'rb');

        while(!feof($fp)) {
            $current_line = fgets($fp);

            if (unserialize($current_line)['id'] == $id) {
                $result = unserialize($current_line);
            }
        }

        fclose($fp);

        if (empty($result)) {
            $result['status'] = 'not found';
        }

        return $result;
    }

    public function getByIdField(string $db, int $id, string $field): string
    {

        $fp = fopen($this->$db,'rb');

        while(!feof($fp)) {
            $current_line = fgets($fp);

            if (unserialize($current_line)['id'] == $id) {

                if (!isset($current_line[$field])){

                    $result = unserialize($current_line)[$field];

                }

            }
        }

        fclose($fp);

        if (empty($result)) {
            $result['status'] = 'not found';
        }

        return $result;
    }

    public function getMaxId($db)
    {
        $fp = fopen($this->$db,'rb');

        while(!feof($fp)) {
            $current_line = fgets($fp);
            if (unserialize($current_line)['id']) {

                $id[] = unserialize($current_line)['id'];


            }
        }

        fclose($fp);

        return max($id);
    }


}