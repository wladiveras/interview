<?php

class Store
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
    public function getAll()
    {
        $this->database->query("SELECT id, name, location FROM stores LIMIT 0,150");

        $results = $this->database->resultset();
        return $results;
    }

    public function getById(int $id)
    {
        $this->database->query("SELECT id, name, location FROM stores WHERE id = :id");
        $this->database->bind(":id", $id);

        $result = $this->database->single();

        return $result;
    }

    public function getAllOrders()
    {
        $this->database->query("SELECT s.id, s.name, s.location, o.id, o.store_id, o.product_name, o.price, o.quantity, o.created_at FROM stores s LEFT JOIN orders o ON s.id = o.store_id LIMIT 0,150");

        $results = $this->database->resultset();

        foreach ($results as $result) {
            $data[] = [
                'id' => $result['id'],
                'name' => $result['name'],
                'location' => $result['location'],
                'order' => [
                    'store_id' => $result['store_id'],
                    'product_name' => $result['product_name'],
                    'price' => $result['price'],
                    'quantity' => $result['quantity'],
                    'created_at' => $result['created_at'],
                ],
            ];
        }

        return $data;
    }

    public function getOrdersById(int $id)
    {
        $this->database->query("SELECT u.id, u.name, u.email, o.id, o.user_id, o.product_name, o.price, o.quantity, o.created_at FROM users u LEFT JOIN orders o ON u.id = o.user_id LIMIT 0,150");

        $results = $this->database->resultset();

        foreach ($results as $result) {
            $data[] = [
                'id' => $result['id'],
                'name' => $result['name'],
                'email' => $result['email'],
                'order' => [
                    'user_id' => $result['user_id'],
                    'product_name' => $result['product_name'],
                    'price' => $result['price'],
                    'quantity' => $result['quantity'],
                    'created_at' => $result['created_at'],
                ],
            ];
        }

        return $data;
    }
}