<?php

require_once('autoload.php');




$url = $_SERVER['REQUEST_URI'];

if (preg_match('/\/([a-z]+)/i', $url, $matches)) {
    $controllerName = ucfirst($matches[1]);
}

if (preg_match('/\/([a-z]+)/i', $url, $matches)) {
    $action_name = $matches[1];
}

$controller = new HomeController();
$controller->index();