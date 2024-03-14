<?php

class Parse
{
    public function xmlToArray($file)
    {

        $xml = simplexml_load_file($file['tmp_name']);

        if ($xml === false) {
            return [];
        }

        return $this->xmlToArrayRecursive($xml);
    }

    private function xmlToArrayRecursive(SimpleXMLElement $xml)
    {
        $result = [];

        foreach ($xml->children() as $child) {
            if ($child->children()->count() > 0) {
                $result[$child->getName()][] = $this->xmlToArrayRecursive($child);
            } else {
                $result[$child->getName()] = (string) $child;
            }
        }

        return $result;
    }

    public function parseExcel($file)
    {
        $zip = new ZipArchive;
        $fileTempName = $file['tmp_name'];
        $res = $zip->open($fileTempName);

        if ($res === TRUE) {
            $tempPath = sys_get_temp_dir();
            $xmlPath = $tempPath . '/xl/worksheets/sheet1.xml';
            $sharedStringsPath = $tempPath . '/xl/sharedStrings.xml';

            $zip->extractTo($tempPath);
            $zip->close();

            $xml = simplexml_load_file($xmlPath);
            $sharedStrings = simplexml_load_file($sharedStringsPath);
            $rows = $xml->sheetData->row;

            $csvData = [];
            $columnNames = ['val0' => 'user_id', 'val1' => 'name', 'val2' => 'email', 'val3' => 'product', 'val4' => 'last_order_at', 'val5' => 'price'];

            foreach ($rows as $row) {
                $data = [];

                foreach ($row->c as $cell) {
                    $cellRef = (string) $cell['r'];
                    $index = ord($cellRef[0]) - ord('A');
                    $key = 'val' . $index;
                    $value = isset($cell->v) ? (string) $cell->v : '';
                    if ($cell['t'] == 's') {
                        $value = (string) $sharedStrings->si[intval($value)]->t;
                    }
                    $data[$columnNames[$key]] = $value;
                }

                $csvData[] = $data;

            }
            array_shift($csvData);

            return json_decode(json_encode($csvData, JSON_UNESCAPED_UNICODE), true);
        } else {
            return [];
        }
    }

    public function getCurrency($value)
    {

        //TODO: Add all numbers name
        $numberWords = [
            "Cinquenta" => 50,
            //Quarenta, Trinta, vinte, dez...
        ];
        if (is_numeric($value)) {
            return $value;
        } else if (!is_null($value)) {
            return $numberWords[$value];
        }

        return null;
    }

}