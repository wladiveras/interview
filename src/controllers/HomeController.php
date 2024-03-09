<?php
class HomeController
{
    public function index()
    {
        $model = new HomeModel();
        $data = $model->getData();
        require_once('views/home.view.php');
    }
}