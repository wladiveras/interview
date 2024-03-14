<?php

class OrderController
{
    private $user;
    private $order;
    private $store;
    private $parse;
    private $response;

    public function __construct()
    {
        $this->user = new User();
        $this->order = new Order();
        $this->store = new Store();
        $this->parse = new Parse();
        $this->response = new Response();
    }

    public function create()
    {
        $type = $_POST['type'];
        $file = $_FILES['data'];

        if ($type === 'text/xml') {

            $data = $this->importXml($file);

            if (isset($data)) {
                $this->createOrder($data);

                return $this->response->json([
                    'status' => 'success',
                    'message' => 'As lojas mágicas e seus pedidos chegaram.',
                ]);
            }
        }

        if ($type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {

            $data = $this->importExcel($file);

            if (isset($data)) {

                $this->createOrder($data);

                return $this->response->json([
                    'status' => 'success',
                    'message' => 'Os bruxos e seus pedidos chegaram.',
                ]);
            }
        }

        return $this->response->json([
            'status' => 'error',
            'message' => 'Erro ao importar arquivo.',
        ]);
    }

    // TODO: this can exist in a service file too.
    private function importXml($file)
    {

        $data = $this->parse->xmlToArray($file);

        $result = [];

        foreach ($data['pedido'] as $value) {
            $result[] = [
                'store_id' => $value['id_loja'],
                'name' => $value['nome_loja'],
                'location' => $value['localizacao'],
                'product' => $value['produto'],
                'quantity' => $value['quantidade'],
            ];
        }

        return $result;
    }

    // TODO: this can exist in a service file too.
    private function importExcel($file)
    {
        return $this->parse->parseExcel($file);
    }

    private function createOrder($data)
    {

        $result = [];

        foreach ($data as $value) {
            if (isset($value['user_id'])) {
                $userId = $this->user->firstOrCreate($value);
            }

            if (isset($value['store_id'])) {
                $storeId = $this->store->firstOrCreate($value);
            }

            $price = $this->parse->getCurrency($value['price']) ?? 10 * $value['quantity'];

            $result[] = $this->order->create([
                'store_id' => $storeId ?? null,
                'user_id' => $userId ?? null,
                'product_name' => $value['product'],
                'price' => $price,
                'quantity' => $value['quantity'] ?? 1,
                'created_at' => $value['last_order_at'] ?? date('Y-m-d H:i:s'),
            ]);
        }

        return $result;
    }

}