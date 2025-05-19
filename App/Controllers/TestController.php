<?php

namespace App\Controllers;

use App\Core\Database;

class TestController
{
    use Database;
    
    public function __construct()
    {

    }

    public function test()
    {
        echo json_encode(['test message' => true]);
        exit;
    }

    public function index()
    {
        try
        {

            $rows = $this->query('SELECT * FROM test');
            echo json_encode(['success' => true, 'data' => $rows]);
        }
        catch(\Exception $e)
        {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }

}