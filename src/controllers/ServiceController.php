
    <?php

    class ServiceController
    {
        public function create($data)
        {
            $response = new Response();
            $data = $_POST;

            if (isset($data['data']) && $data['type'] && $data['type'] === 'xml') {
                $data = $this->parseXml($data);
            } else {
                return $response->json([
                    'status' => 'error',
                    'message' => 'Nenhum arquivo foi enviado.',
                ]);
            }

            return $response->json([
                'status' => 'success',
                'message' => 'Arquivo importado com sucesso.',
            ]);
        }

        private function parseXml($data)
        {
            $parse = new Parse();
            $data = urldecode($data['data']);
            $data = $parse->xmlToArray($data);

            return $data;
        }

        private function parseExcel($data)
        {
            $parse = new Parse();
            $data = $parse->xmlToArray($data);

            return $data;
        }
    }