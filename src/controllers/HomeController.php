<?php
require_once __DIR__ . '/../config/app.php';
class HomeController
{
    private $user;
    private $order;
    private $store;
    private $parse;
    private $response;

    public function __construct()
    {
        $this->user = new User();
        $this->order = new Order();
        $this->store = new Store();
        $this->parse = new Parse();
        $this->response = new Response();
    }

    public function index()
    {
        require_once('views/home.view.php');
    }

    public function allOrders()
    {
        $orders = $this->order->getAll();

        $this->response->json($orders);
    }

    public function getOrderById($request)
    {
        $order = $this->order->getById($request['id']);

        $this->response->json($order);
    }

    public function getUserOrders($request)
    {
        $order = $this->user->getOrdersByUserId($request['id']);

        $this->response->json($order);
    }

    public function getStoreOrders($request)
    {
        $order = $this->store->getOrdersByStoreId($request['id']);

        $this->response->json($order);
    }
}