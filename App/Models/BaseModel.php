<?php

namespace App\Models;

use App\Core\Database;

abstract class BaseModel
{

    protected $table;
    protected $db;

    function __construct($__constructTable)
    {
        $this->table = $__constructTable;
        $this->db = new Database();
    }

	public function query($query, $data = [])
	{

	}

    public function select(string ...$columns)
    {
        $cols = $columns ? implode(', ', $columns) : "*";
        $sql = "SELECT $cols FROM {$this->table}";
        $stmt = $this->db->query($sql);
        return $stmt;
    }

    public function insert(array $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sql =  "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
    } 

    public function delete()
    {

    }
}