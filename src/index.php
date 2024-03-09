<?php

require_once('autoload.php');

$url = $_SERVER['REQUEST_URI'];

$routes = [
    '/home' => ['HomeController', 'index'],
    '/about' => ['AboutController', 'index'],
    '/contact' => ['ContactController', 'index'],
];

$controllerName = 'HomeController';
$actionName = 'index';

foreach ($routes as $route => $handler) {
    if (preg_match('#^' . $route . '$#i', $url, $matches)) {
        $controllerName = $handler[0];
        $actionName = $handler[1];
        break;
    }
}

if (!empty($controllerName) && !empty($actionName)) {
    $controller = new $controllerName();
    $controller->$actionName($matches);
} else {
    echo '404 Not Found';
}

