<?php

namespace App\Models;

use App\Models\BaseModel;

class TestModel extends BaseModel
{
    function __construct()
    {
        parent::__construct("test");
    }
}