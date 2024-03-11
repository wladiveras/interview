<?php

class HomeController
{
    public function index()
    {
        $model = new User();
        $data = $model->getData();

        $response = new Response();

        return $response->json($data);

        // MVC RESPONSE
        // require_once('views/home.view.php');
    }

    public function create($data)
    {

        $users = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
            ['id' => 2, 'name' => 'Jane Doe', 'email' => 'jane@example.com'],
        ];

        $xml = new SimpleXMLElement('<users/>');

        foreach ($users as $user) {
            $userNode = $xml->addChild('user');
            $userNode->addChild('id', $user['id']);
            $userNode->addChild('name', $user['name']);
            $userNode->addChild('email', $user['email']);
        }

        $xmlUsers = $xml->asXML();

        $parse = new Parse();
        $data = $parse->xmlToArray($xmlUsers);

        $response = new Response();

        return $response->json($data);

        // MVC RESPONSE
        // require_once('views/home.view.php');
    }
}