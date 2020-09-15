<?php

namespace App\Models;

/**
 * Class DataValidation
 *
 * Validation incoming data
 *
 *
 * @package App\Models
 */

class DataValidation
{
    /**
     * var data (all data container)
     *
     * @var data
     */
    protected $data;

    /**
     * DataValidation constructor.
     *
     *assigns to a variable data from global var $_POST
     *
     * @param $post
     */
    public function __construct($post)
    {

        $this->data = $post;

    }



}