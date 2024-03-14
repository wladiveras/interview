<?php

class User
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getAll()
    {
        $this->database->query("SELECT id, name, email FROM users LIMIT 0,150");

        $results = $this->database->resultset();
        return $results;
    }

    public function getById(int $id)
    {
        $this->database->query("SELECT id, name, email FROM users WHERE id = :id");
        $this->database->bind(":id", $id);

        $result = $this->database->single();

        return $result;
    }

    public function firstOrCreate(array $data)
    {

        $this->database->query("SELECT id, name, email FROM users WHERE id = :id");
        $this->database->bind(":id", $data['user_id']);

        $result = $this->database->single();

        if (!$result) {
            $this->database->query("INSERT INTO users (name, email) VALUES (:name, :email)");
            $this->database->bind(":name", $data['name']);
            $this->database->bind(":email", $data['email']);

            $this->database->execute();
            return $this->database->lastInsertId();
        }

        return $result->id;

    }

    public function getAllOrders()
    {
        $this->database->query("SELECT u.id, u.name, u.email, o.id, o.user_id, o.product_name, o.price, o.quantity, o.created_at FROM users u LEFT JOIN orders o ON u.id = o.user_id ORDER BY o.id DESC LIMIT 0,150");

        $results = $this->database->resultset();

        $data = [];

        foreach ($results as $result) {
            $userId = $result['id'];
            if (!isset($data[$userId])) {
                $data[$userId] = [
                    'id' => $result['id'],
                    'name' => $result['name'],
                    'email' => $result['email'],
                    'orders' => [],
                ];
            }
            if ($result['user_id']) {
                $data[$userId]['orders'][] = [
                    'id' => $result['id'],
                    'user_id' => $result['user_id'],
                    'product_name' => $result['product_name'],
                    'price' => $result['price'],
                    'quantity' => $result['quantity'],
                    'created_at' => $result['created_at'],
                ];
            }
        }

        return array_values($data);
    }


    public function getOrdersByUserId(int $id)
    {
        $this->database->query("SELECT u.id, u.name, u.email, o.id as order_id, o.user_id, o.product_name, o.price, o.quantity, o.created_at FROM users u LEFT JOIN orders o ON u.id = o.user_id WHERE u.id = :user_id ORDER BY o.id DESC LIMIT 0,150");
        $this->database->bind(":user_id", $id);
        $results = $this->database->resultset();

        $data = [];

        foreach ($results as $result) {
            $userId = $result['id'];
            if (!isset($data[$userId])) {
                $data[$userId] = [
                    'id' => $result['id'],
                    'name' => $result['name'],
                    'email' => $result['email'],
                    'orders' => [],
                ];
            }
            if ($result['user_id']) {
                $data[$userId]['orders'][] = [
                    'id' => $result['id'],
                    'user_id' => $result['user_id'],
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