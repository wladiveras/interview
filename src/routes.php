<?php

$routes = [
    ['GET', '/home', 'HomeController', 'index'],
    ['GET', '/all-orders', 'HomeController', 'allOrders'],
    ['GET', '/order/{id}', 'HomeController', 'getOrderById'],
    ['GET', '/order/user/{id}', 'HomeController', 'getUserOrders'],
    ['GET', '/order/store/{id}', 'HomeController', 'getStoreOrders'],

    ['POST', '/import', 'OrderController', 'create'],
];