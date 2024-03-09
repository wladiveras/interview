<?php
class HomeController
{
    public function index()
    {
        $model = new User();
        $data = $model->getData();
        require_once('views/home.view.php');
    }
}