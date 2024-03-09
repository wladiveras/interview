<?php

require_once('autoload.php');
require_once('routes.php');

$url = $_SERVER['REQUEST_URI'];


$controllerName = 'HomeController';
$actionName = 'index';
$matches = [];

foreach ($routes as $route) {
    [$method, $pattern, $handler, $action] = $route;

    if ($method !== $_SERVER['REQUEST_METHOD']) {
        continue;
    }

    $regex = '#^' . preg_replace('#\{(\w+)\}#', '(?<$1>[^/]+)', $pattern) . '$#i';

    if (preg_match($regex, $url, $matches)) {
        $controllerName = $handler;
        $actionName = $action;
        break;
    }
}

if (!empty($controllerName) && !empty($actionName)) {
    $controller = new $controllerName();
    $controller->$actionName($matches);
} else {
    echo '404 Not Found';
}

