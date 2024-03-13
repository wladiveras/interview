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

    public function create($data)
    {
        $this->database->query("INSERT INTO orders (store_id, user_id, product_name, price, quantity, created_at) VALUES (:store_id, :user_id, :product_name, :price, :quantity, :created_at)");
        $this->database->bind(":store_id", $data['store_id']);
        $this->database->bind(":user_id", $data['user_id']);
        $this->database->bind(":product_name", $data['product_name']);
        $this->database->bind(":price", $data['price']);
        $this->database->bind(":quantity", $data['quantity']);
        $this->database->bind(":created_at", $data['created_at']);

        $this->database->execute();

        return $this->database->lastInsertId();
    }
}