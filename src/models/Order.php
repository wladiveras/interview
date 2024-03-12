<?php
class Order
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
            'store_id' => 1,
            'user_id' => 1,
            'product_name' => 'Areia Mágica',
            'price' => 20,
            'quantity' => 20,
            'created_at' => '2020-01-01 00:00:00',
        ];
    }
}