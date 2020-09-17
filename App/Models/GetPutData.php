<?php

namespace App\Models;
/**
 * Class GetPutData
 *
 * Parse data from php input
 *
 * @package App\Models
 */
class GetPutData
{
    /**
     * @return array|mixed
     */
    public static function fromPhpInput()
    {
        $put = [];

        /**
         *
         *get data from the (PUT) request
         *
         * $input
         */
        $input = file_get_contents('php://input');


        switch (true) {
            /**
             * multipart/form-data
             */
            case preg_match_all('/((-*[a-zA-Z0-9]*)Content-Disposition: form-data; name=")|(--------------------------[a-zA-Z0-9]*--)/u', $input, $matches) > 0:
                /**
                 *
                 *remove all \r\n
                 *
                 */
                $input = preg_replace('/[\r\n]*/', '', $input);

                /**
                 *
                 *delete all technical information
                 *
                 */
                $input = preg_replace('/((-*[a-zA-Z0-9]*)Content-Disposition: form-data; name=")|(--------------------------[a-zA-Z0-9]*--)/u', '-|-', $input);

                /**
                 *explode string to array by del -|-
                 *
                 */
                $arr = explode('-|-', $input);
                /**
                 *
                 *del from arr empty fields
                 *
                 */
                $arr = array_diff($arr, ['', NULL, false]);
                /**
                 *
                 *collecting a clean data array
                 *
                 */
                foreach ($arr as $value){
                    preg_match('/^[a-zA-Z0-9-_]*(?="{1})/u', $value, $key);
                    preg_match('/(?<="{1}).*/u', $value,$newValue);
                    $put[$key[0]] = $newValue[0];
                }
                /**
                 *
                 *del from arr empty fields
                 *
                 */
                $put = array_diff($put, ['', NULL, false]);
                break;
            /**
             * application/x-www-form-urlencoded
             */
            case preg_match_all('/^.*=.*&*$/', $input, $matches) > 0:

                $exploded = explode('&', $input);

                /**
                 *
                 *collecting a clean data array
                 *
                 */
                foreach($exploded as $pair) {
                    $item = explode('=', $pair);
                    if (count($item) == 2) {
                        $put[urldecode($item[0])] = urldecode($item[1]);
                    }
                }
                break;
            /**
             * raw data (only json)
             */
            case preg_match_all('/\{[(\n)*(\t)*\{\}\"\S:,*\s]*\}/', $input, $matches) > 0:
                $put = json_decode($input, true);
                break;
            default:
                $put = ['success' => false];
        }

        return $put;
    }

}