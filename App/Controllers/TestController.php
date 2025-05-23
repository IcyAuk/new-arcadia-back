<?php

namespace App\Controllers;

use App\Core\Database;
use App\Controllers\BaseController;
use App\Models\TestModel;

class TestController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new TestModel();
    }

    public function test()
    {

    }

    public function index()
    {
        $this->jsonResponse(
            [
                'message' => $this->model->select()
            ]
        );
    }

}