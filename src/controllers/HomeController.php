<?php
require_once __DIR__ . '/../config/app.php';
class HomeController
{

    public function index()
    {

        $name = 'something';
        $data = [
            'id' => 1,
            'name' => $name
        ];


        require_once('views/home.view.php');
    }
}