
    <?php

    class OrderController
    {
        public function create($data)
        {
            $response = new Response();
            $data = $_POST;

            // Import Xml data
            if (isset($data['data']) && $data['type'] && $data['type'] === 'xml') {
                $data = $this->importXml($data);

                if (isset($data)) { {
                        $this->createOrder($data);

                        return $response->json([
                            'status' => 'success',
                            'message' => $data,
                        ]);
                    }
                }
            }

            if (isset($data['data']) && $data['type'] && $data['type'] === 'excel') {
                $data = $this->importExcel($data);

                if (isset($data)) {
                    return $response->json([
                        'status' => 'success',
                        'message' => 'Arquivo importado com sucesso.',
                    ]);
                }
            }

            return $response->json([
                'status' => 'error',
                'message' => 'Erro ao importar arquivo.',
            ]);
        }

        // TODO: this can exist in a service file too, and can add a create a store if not exist instend sql file.
        private function importXml($data)
        {
            $parse = new Parse();
            $data = urldecode($data['data']);

            $data = $parse->xmlToArray($data);

            $result = [];

            foreach ($data['pedido'] as $value) {
                $result[] = [
                    'store_id' => $value['id_loja'],
                    'product' => $value['produto'],
                    'quantity' => $value['quantidade'],
                ];
            }

            return $result;
        }

        private function createOrder($data)
        {
            $order = new Order();
            $result = [];

            foreach ($data as $value) {

                $prince = $value['price'] ?? 10 * $value['quantity'];
                $result[] = $order->create([
                    'store_id' => $value['store_id'] ?? null,
                    'user_id' => $value['user_id'] ?? null,
                    'product_name' => $value['product'],
                    'price' => $prince,
                    'quantity' => $value['quantity'] ?? 1,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }

            return $result;
        }

        private function importExcel($data)
        {
            $parse = new Parse();
            $data = urldecode($data['data']);
            $data = $parse->xmlToArray($data);

            return $data;
        }
    }