<?php

class OrderController
{
    public function create($data)
    {
        $response = new Response();

        $type = $_POST['type'];
        $file = $_FILES['data'];

        if ($type === 'xml') {

            $data = $this->importXml($file);

            if (isset($data)) {
                $this->createOrder($data);

                return $response->json([
                    'status' => 'success',
                    'message' => 'Dados do arquivo importado com sucesso.',
                ]);
            }
        }

        if ($type === 'xlsx') {
            $data = $this->importExcel($file);


            if (isset($data)) {
                return $response->json([
                    'status' => 'success',
                    'message' => $data,
                ]);
            }
        }

        return $response->json([
            'status' => 'error',
            'message' => 'Erro ao importar arquivo.',
        ]);
    }

    // TODO: this can exist in a service file too, and can add a create a store if not exist instend sql file.
    private function importXml($file)
    {
        $parse = new Parse();

        print_r($file);


        $data = $parse->xmlToArray($file);

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

    private function importExcel($data)
    {
        $type = $_POST['type'];
        $file = $_FILES['file'];

        $zip = new ZipArchive;
        $res = $zip->open($file['tmp_name']);

        if ($res === TRUE) {
            $zip->extractTo('/path/to/extract/to');
            $zip->close();

            $xml = simplexml_load_file('/path/to/extract/to/xl/worksheets/sheet1.xml');
            $rows = $xml->sheetData->row;

            $csvFile = fopen('/path/to/save/file.csv', 'w');

            foreach ($rows as $row) {
                $data = [];

                foreach ($row->c as $cell) {
                    $data[] = (string) $cell->v;
                }

                fputcsv($csvFile, $data);
            }

            fclose($csvFile);
        } else {
            echo 'Failed to open file';

        }

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

}