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
        // TODO: ADD A REAL SQL
        return [
            'id' => 1,
            'name' => 'Wladi Granger',
            'email' => 'wladi@grifinoria.hogwarts'
        ];
    }
}