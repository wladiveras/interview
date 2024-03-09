<?php

class HomeController
{
    public function index()
    {
        $model = new User();
        $data = $model->getData();
        $response = new Response();
        return $response->json($data);

        // require_once('views/home.view.php');
    }
}