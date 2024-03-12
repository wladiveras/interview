<?php

class Store
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
            'name' => 'Wladi Poções Magicas',
            'location' => 'Rio de Janeiro - Beco diagonal, Hogwarts, 1997',
        ];
    }
}