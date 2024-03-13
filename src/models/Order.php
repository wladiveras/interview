<?php
class Order
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getById(int $id)
    {
        $this->database->query("SELECT id, store_id, user_id, product_name, price, quantity, created_at FROM orders WHERE id = :id");
        $this->database->bind(":id", $id);

        $result = $this->database->single();

        return $result;
    }

    public function getAll()
    {
        $this->database->query("SELECT  id, store_id, user_id, product_name, price, quantity, created_at FROM orders ORDER BY id DESC LIMIT 0,150");

        $results = $this->database->resultset();

        return array_values($results);
    }
}