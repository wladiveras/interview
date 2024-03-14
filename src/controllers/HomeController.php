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

        $this->response->json([
            'status' => $orders ? 'success' : 'error',
            'data' => $orders,
        ]);
    }

    public function getOrderById($id)
    {
        $order = $this->order->getById($id);

        $this->response->json([
            'status' => $order ? 'success' : 'error',
            'data' => $order,
        ]);
    }

    public function getUserOrders($id)
    {
        $order = $this->user->getById($id);

        $this->response->json([
            'status' => $order ? 'success' : 'error',
            'data' => $order,
        ]);
    }

    public function getStoreOrders($id)
    {
        $order = $this->store->getById($id);

        $this->response->json([
            'status' => $order ? 'success' : 'error',
            'data' => $order,
        ]);
    }


}