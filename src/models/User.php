<?php

class User
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
    public function getData()
    {
        $this->database->query("SELECT * FROM users LIMIT 0,10");

        $rows = $this->database->resultset();
        return $rows;

    }
}