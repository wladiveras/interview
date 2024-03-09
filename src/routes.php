<?php

$routes = [
    ['GET', '/home', 'HomeController', 'index'],
    ['GET', '/about', 'AboutController', 'index'],
    ['GET', '/contact', 'ContactController', 'index'],
    ['POST', '/contact', 'ContactController', 'store'],
    ['PUT', '/contact/{id}', 'ContactController', 'update'],
    ['DELETE', '/contact/{id}', 'ContactController', 'delete'],
];