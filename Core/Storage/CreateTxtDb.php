<?php

namespace Core\Storage;

use Bases\TxtDb;

class CreateTxtDb extends Storage
{
    public function get()
    {
        return new TxtDb();
    }
}