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
        $this->database->query("SELECT s.id, s.name, s.location, o.id, o.store_id, o.product_name, o.price, o.quantity, o.created_at FROM stores s LEFT JOIN orders o ON s.id = o.store_id  ORDER BY o.id DESC LIMIT 0,150");

        $results = $this->database->resultset();

        $data = [];

        foreach ($results as $result) {
            $userId = $result['id'];
            if (!isset($data[$userId])) {
                $data[$userId] = [
                    'id' => $result['id'],
                    'name' => $result['name'],
                    'location' => $result['location'],
                    'orders' => [],
                ];
            }

            if ($result['store_id']) {
                $data[$userId]['orders'][] = [
                    'id' => $result['id'],
                    'store_id' => $result['store_id'],
                    'product_name' => $result['product_name'],
                    'price' => $result['price'],
                    'quantity' => $result['quantity'],
                    'created_at' => $result['created_at'],
                ];
            }
        }

        return array_values($data);
    }

    public function getOrdersByStoreId(int $id)
    {
        $this->database->query("SELECT s.id, s.name, s.location, o.id as store_id, o.store_id, o.product_name, o.price, o.quantity, o.created_at FROM stores s LEFT JOIN orders o ON s.id = o.store_id WHERE s.id = :store_id ORDER BY o.id DESC LIMIT 0,150");
        $this->database->bind(":store_id", $id);
        $results = $this->database->resultset();

        $data = [];

        foreach ($results as $result) {
            $userId = $result['id'];
            if (!isset($data[$userId])) {
                $data[$userId] = [
                    'id' => $result['id'],
                    'name' => $result['name'],
                    'location' => $result['location'],
                    'orders' => [],
                ];
            }

            if ($result['store_id']) {
                $data[$userId]['orders'][] = [
                    'id' => $result['id'],
                    'store_id' => $result['store_id'],
                    'product_name' => $result['product_name'],
                    'price' => $result['price'],
                    'quantity' => $result['quantity'],
                    'created_at' => $result['created_at'],
                ];
            }
        }

        return array_values($data);
    }
}